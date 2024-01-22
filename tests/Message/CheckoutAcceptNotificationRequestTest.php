<?php

namespace Omnipay\Rapyd\Tests\Message;

use Omnipay\Rapyd\Message\CheckoutAcceptNotificationRequest;
use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request;

class CheckoutAcceptNotificationRequestTest extends TestCase
{
    public function testAcceptNotification()
    {
        $mockResponse = $this->getMockHttpResponse('CheckoutAcceptNotification.txt');
        $httpRequest = new Request([], [], [], [], [], [
            'HTTP_SALT' => $mockResponse->getHeader('HTTP-SALT')[0],
        ], (string) $mockResponse->getBody());

        $checkoutAcceptNotificationRequest = new CheckoutAcceptNotificationRequest(
            $this->getHttpClient(),
            $httpRequest
        );

        $response = $checkoutAcceptNotificationRequest->send();

        self::assertEquals('CLO', $response->getCode());
        self::assertEquals('payment_0fe57557849d4ddd523dae5568fbff4b', $response->getTransactionReference());
        self::assertEquals('abcd12345678', $response->getTransactionId());
    }
}
