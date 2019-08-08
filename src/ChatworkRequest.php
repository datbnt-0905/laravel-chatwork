<?php

namespace SunAsterisk\Chatwork\Laravel;

use SunAsterisk\Chatwork\Helpers\Webhook;
use Illuminate\Http\Request;

class ChatworkRequest extends Request
{
    /**
     * @return string
     */
    public function type()
    {
        $body = json_decode($this->getContent(), true);
        return $body['webhook_event_type'];
    }

    /**
     * @return string
     */
    public function id()
    {
        $body = json_decode($this->getContent(), true);
        return $body['webhook_setting_id'];
    }

    /**
     * @return int
     */
    public function timestamp()
    {
        $body = json_decode($this->getContent(), true);
        return $body['webhook_event_time'];
    }

    /**
     * @return array
     */
    public function event()
    {
        $body = json_decode($this->getContent(), true);
        return $body['webhook_event'];
    }

    /**
     * @param string $token
     * @return bool
     */
    public function verifySignature(string $token)
    {
        $signature = $this->header('X-ChatWorkWebhookSignature');
        $body = $this->getContent();
        return Webhook::verifySignature($token, $body, $signature);
    }
}
