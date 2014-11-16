<?php
namespace Craft;

class VzWooferService extends BaseApplicationComponent
{
    private $cacheKey = 'vzWooferFormsList';
    private $cacheDuration = 'PT1H';

    public function listForms($subdomain=false, $apiKey=false)
    {
        if (!$subdomain || $apiKey)
        {
            $settings = craft()->plugins->getPlugin("vzWoofer")->getSettings();
            $subdomain = $settings->subdomain;
            $apiKey = $settings->apiKey;
        }

        // Use the cached list, if it exists
        $forms = craft()->cache->get($this->cacheKey);

        // If not cached, get from the API
        if (true || !$forms)
        {
            try
            {
                $client = new \Guzzle\Http\Client("https://$subdomain.wufoo.com");
                $request = $client->get('/api/v3/forms.json?IncludeTodayCount=true');
                $request->setAuth($apiKey, 'pass', CURLAUTH_BASIC);
                $response = $request->send()->json();

                $forms = array();
                foreach ($response['Forms'] as $form)
                {
                    $forms[$form['Hash']] = array_change_key_case($form);
                }

                // Cache it
                craft()->cache->set($this->cacheKey, $forms, $this->cacheDuration);
            }
            catch (\Exception $e)
            {
                return $e->getResponse()->getReasonPhrase();
            }
        }

        return $forms;
    }
}