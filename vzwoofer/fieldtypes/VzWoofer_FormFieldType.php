<?php
namespace Craft;

class VzWoofer_FormFieldType extends BaseFieldType
{
    public function getName()
    {
        return Craft::t('Wufoo Form');
    }

    public function getInputHtml($name, $value)
    {
        // Reformat the input name into something that looks more like an ID
        $id = craft()->templates->formatInputId($name);

        // Get the forms
        $forms = array('' => '');
        foreach (craft()->vzWoofer->listForms() as $form)
        {
            $forms[$form['hash']] = $form['name'];
        }

        return craft()->templates->render('vzwoofer/fieldtype/input', array(
            'id'    => $id,
            'name'  => $name,
            'value' => $value['hash'],
            'options' => $forms,
        ));
    }

    public function prepValue($value)
    {
        $settings = craft()->plugins->getPlugin("vzWoofer")->getSettings();
        $data = array('hash' => $value);
        $forms = craft()->vzWoofer->listForms();

        if (isset($forms[$value]))
        {
            $form                = $forms[$value];
            $data['name']        = $data['title'] = $form['name'];
            $data['description'] = $form['description'];
            $data['message']     = $form['redirectmessage'];
            $data['url']         = 'https://' . $settings['subdomain'] . '.wufoo.com/forms/' . $form['hash'] . '/';
            $data['prettyUrl']   = 'https://' . $settings['subdomain'] . '.wufoo.com/forms/' . $form['url'] . '/';
            $data['public']      = $form['ispublic'] > 0;
            $data['postDate']    = DateTime::createFromFormat(DateTime::MYSQL_DATETIME, $form['startdate']);
            $data['expiryDate']  = DateTime::createFromFormat(DateTime::MYSQL_DATETIME, $form['enddate']);
            $data['dateCreated'] = DateTime::createFromFormat(DateTime::MYSQL_DATETIME, $form['datecreated']);
            $data['dateUpdated'] = DateTime::createFromFormat(DateTime::MYSQL_DATETIME, $form['dateupdated']);
            $data['embed']       = "<div id='wufoo-{$data['hash']}'></div>"
                                 . "<script type='text/javascript'>var {$data['hash']};(function(d, t) {"
                                 . "var s = d.createElement(t), options = {"
                                 . "'userName':'{$settings['subdomain']}',"
                                 . "'formHash':'{$data['hash']}',"
                                 . "'autoResize':true,"
                                 . "'async':true,"
                                 . "'host':'wufoo.com',"
                                 . "'header':'show',"
                                 . "'ssl':true};"
                                 . "s.src = ('https:' == d.location.protocol ? 'https://' : 'http://') + 'www.wufoo.com/scripts/embed/form.js';"
                                 . "s.onload = s.onreadystatechange = function() {"
                                 . "var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;"
                                 . "try { {$data['hash']} = new WufooForm();{$data['hash']}.initialize(options);{$data['hash']}.display(); } catch (e) {}};"
                                 . "var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);"
                                 . "})(document, 'script');</script>";
        }

        return $data;
    }
}