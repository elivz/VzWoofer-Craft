<?php
namespace Craft;

class VzWoofer_FormsWidget extends BaseWidget
{
    public function getName()
    {
        return Craft::t('Wufoo Forms');
    }

    public function getBodyHtml()
    {
        $settings = craft()->plugins->getPlugin("vzWoofer")->getSettings();
        $forms = array();

        if (isset($settings['apiKey']) && isset($settings['subdomain']))
        {
            $forms = craft()->vzWoofer->listForms();
        }

        return craft()->templates->render('vzwoofer/widgets/body', array(
            'subdomain' => $settings['subdomain'],
            'forms' => $forms
        ));
    }
}