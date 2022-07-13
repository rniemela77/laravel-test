<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter
{
    public function subscribe(string $email)
    {
        $mailchimp = new ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us13'
        ]);

        return $mailchimp->lists->addListMember('feb7cad718', [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }
}
