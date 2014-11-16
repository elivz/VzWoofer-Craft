<?php
namespace Craft;

class VzWoofer_FormsController extends BaseController
{
    public function actionList()
    {
        $subdomain = craft()->request->getParam('subdomain');
        $apiKey = craft()->request->getParam('apiKey');
        $forms = craft()->vzWoofer->listForms($subdomain, $apiKey);

        if (is_array($forms))
        {
            $this->returnJson($forms);
        }
        else
        {
            $this->returnErrorJson($forms);
        }
    }
}