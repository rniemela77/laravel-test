<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter
{
    public function subscribe(string $email)
    {
        return $this->client()->lists->addListMember(
            config('services.mailchimp.lists.subscribers'), [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }

    protected function client(): ApiClient
    {
        return (new ApiClient())->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us13'
        ]);
    }
}
