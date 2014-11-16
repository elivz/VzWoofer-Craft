<?php

/**
 * VZ Woofer for Craft
 *
 * @package    VZ Woofer
 * @author     Eli Van Zoeren
 * @copyright  Copyright (c) 2014, Eli Van Zoeren
 * @repository http://github.com/elivz/VzWoofer-Craft
 */

namespace Craft;

class VzWooferPlugin extends BasePlugin
{
    function getName()
    {
        return Craft::t('VZ Woofer');
    }

    function getVersion()
    {
        return '0.5.0';
    }

    function getDeveloper()
    {
        return 'Eli Van Zoeren';
    }

    function getDeveloperUrl()
    {
        return 'http://elivz.com/';
    }

    public function init()
    {
        // if (!craft()->isConsole())
        // {
        //     if (craft()->request->isCpRequest())
        //     {
        //         craft()->templates->includeCssResource('vzWoofer/redactor/wufoo.css');
        //         craft()->templates->includeJsResource('vzWoofer/redactor/wufoo.js');
        //         $modalHtml = craft()->templates->render('vzWoofer/modal', array(
        //             'forms' => craft()->vzWoofer_forms->listForms()
        //         ));
        //         craft()->templates->includeFootHtml($modalHtml);
        //     }
        // }
    }

    protected function defineSettings()
    {
        return array(
            'apiKey' => AttributeType::String,
            'subdomain' => AttributeType::String,
            'forms' => array(AttributeType::Mixed, 'defaut'=>false),
        );
    }

    public function getSettingsHtml()
    {
        craft()->templates->includeJsResource('vzwoofer/js/settings.js');
        return craft()->templates->render('vzwoofer/settings', array(
            'settings' => $this->getSettings()
        ));
    }

    public function prepSettings($settings)
    {
        // Clear the cached forms list when the API settings are updated
        craft()->cache->delete('vzWooferFormsList');
        return $settings;
    }
}