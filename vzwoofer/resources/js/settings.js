$(document).ready(function() {

    var $link = $('#settings-api-link');
    $('#settings-subdomain').on('change', function() {
        var val = $(this).val();
        if (val) {
            $link.text( Craft.t('or by clicking here')).attr('href', 'https://'+val+'.wufoo.com/api/code/');
        } else {
            $link.text('').removeAttr('href');
        }
    });

    $('#settings-api-connect').on('click', function(e) {
        var $msg = $('#settings-connection-msg').empty(),
            subdomain = $('#settings-subdomain').val(),
            apiKey = $('#settings-apiKey').val(),
            url = Craft.getActionUrl('vzWoofer/forms/list');

        // Add spinner so they know it's working
        var $spinner = $('<div class="spinner"/>').insertAfter(this);

        // Get the list of forms
        $.getJSON(
            url,
            { subdomain:subdomain, apiKey:apiKey },
            function(data) {
                var msg = '';

                if (data.error) {
                    msg = '<strong>Could not connect</strong>: ' + data.error + '. Double-check your settings and try again.';
                } else {
                    var forms = $.map(data, function(item) {
                        return item.name;
                    }).join(', ');

                    msg = '<strong>Connected successfully!</strong> We found the following forms in your account: ' + forms + '.';
                }

                $msg.html(msg);
            })
            .always(function() {
                $spinner.remove();
            });

        return false;
    });

});