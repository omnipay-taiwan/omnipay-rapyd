<?php

namespace Omnipay\Rapyd\Tests\Message;

use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Rapyd\Message\CheckoutAcceptNotificationRequest;
use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request;

class CheckoutAcceptNotificationRequestTest extends TestCase
{
    public function testPaymentCompleted()
    {
        $mockResponse = $this->getMockHttpResponse('WebhookPaymentCompleted.txt');
        $httpRequest = new Request([], [], [], [], [], [
            'HTTPS' => 'on',
            'REQUEST_METHOD' => 'POST',
            'HTTP_HOST' => 'foo.bar',
            'REQUEST_URI' => '/notify',
            'HTTP_TIMESTAMP' => $mockResponse->getHeader('HTTP-TIMESTAMP')[0],
            'HTTP_SIGNATURE' => $mockResponse->getHeader('HTTP-SIGNATURE')[0],
            'HTTP_SALT' => $mockResponse->getHeader('HTTP-SALT')[0],
        ], (string) $mockResponse->getBody());

        $request = new CheckoutAcceptNotificationRequest(
            $this->getHttpClient(),
            $httpRequest
        );
        $request->initialize(array_merge([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
            'testMode' => 1,
        ]));

        self::assertEquals(NotificationInterface::STATUS_COMPLETED, $request->getTransactionStatus());

        $response = $request->send();

        self::assertTrue($response->isSuccessful());
        self::assertEquals('CLO', $response->getCode());
        self::assertEquals('payment_cffe17e09504636e9d09b99bbc027272', $response->getTransactionReference());
        self::assertEquals('abcd12345678', $response->getTransactionId());
    }

    public function testPaymentCanceled()
    {
        $mockResponse = $this->getMockHttpResponse('WebhookPaymentCanceled.txt');
        $httpRequest = new Request([], [], [], [], [], [
            'HTTPS' => 'on',
            'REQUEST_METHOD' => 'POST',
            'HTTP_HOST' => 'foo.bar',
            'REQUEST_URI' => '/notify',
            'HTTP_TIMESTAMP' => $mockResponse->getHeader('HTTP-TIMESTAMP')[0],
            'HTTP_SIGNATURE' => $mockResponse->getHeader('HTTP-SIGNATURE')[0],
            'HTTP_SALT' => $mockResponse->getHeader('HTTP-SALT')[0],
        ], (string) $mockResponse->getBody());

        $request = new CheckoutAcceptNotificationRequest(
            $this->getHttpClient(),
            $httpRequest
        );
        $request->initialize(array_merge([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
            'testMode' => 1,
        ]));

        self::assertEquals(NotificationInterface::STATUS_FAILED, $request->getTransactionStatus());

        $response = $request->send();

        self::assertEquals('CAN', $response->getCode());
        self::assertFalse($response->isSuccessful());
        self::assertTrue($response->isCancelled());
        self::assertEquals('payment_73e7b358841400509e208bd1213e38a7', $response->getTransactionReference());
        self::assertEquals('abcd12345678', $response->getTransactionId());
    }
}
