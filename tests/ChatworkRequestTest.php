<?php

use SunAsterisk\Chatwork\Laravel\ChatworkRequest;

class ChatworkRequestTest extends TestCase
{
    /**
     * @return ChatworkRequest
     */
    protected function getRequest()
    {
        $body = require "Fixtures/request.php";
        $request = new ChatworkRequest([], [], [], [], [], [], $body);
        return $request;
    }

    public function testType()
    {
        $except = "mention_to_me";
        $request = $this->getRequest();
        $type = $request->type();
        $this->assertEquals($type, $except);
    }

    public function testId()
    {
        $except = 12345;
        $request = $this->getRequest();
        $id = $request->id();
        $this->assertEquals($id, $except);
    }

    public function testTimestamp()
    {
        $except = 1498028130;
        $request = $this->getRequest();
        $timestamp = $request->timestamp();
        $this->assertEquals($timestamp, $except);
    }

    public function testEvent()
    {
        $body = require "Fixtures/request.php";
        $body = json_decode($body, true);
        $except = $body['webhook_event'];
        $request = $this->getRequest();
        $event = $request->event();
        $this->assertEquals($event, $except);
    }

    public function testVerifySignatureReturnTrue()
    {
        $token = 'test';
        $signature = 'cJ9U13bNloO3GyDI4F2PSrSqSqjSndvyxLmaQSpkA1E=';
        $request = $this->getRequest();
        $request->headers->set('X-ChatWorkWebhookSignature', $signature);
        $this->assertTrue($request->verifySignature($token));
    }

    public function testVerifySignatureReturnFalse()
    {
        $token = 'test';
        $signature = 'test';
        $request = $this->getRequest();
        $request->headers->set('X-ChatWorkWebhookSignature', $signature);
        $this->assertFalse($request->verifySignature($token));
    }
}
