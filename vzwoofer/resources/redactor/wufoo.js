if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.wufoo = {

    init: function() {
        var callback = $.proxy(function() {
            $('#redactor_modal').find('.redactor_wufoo_link').each($.proxy(function(i, s) {
                $(s).click($.proxy(function() {
                    this.insertForm($(s).data('form-id'));
                    return false;

                }, this));
            }, this));

            this.selectionSave();
            this.bufferSet();

        }, this );

        this.buttonAdd('wufoo', 'Wufoo Form', function(e) {
            this.modalInit('Wufoo Form', '#wufoo-modal', 500, callback);
        });
    },

    insertForm: function(formId) {
        this.selectionRestore();
        this.insertHtml(formId);
        this.modalClose();
    }

};
