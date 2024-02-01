<?php

namespace Omnipay\Rapyd\Tests\Message;

use Omnipay\Rapyd\Message\PaymentCancelRequest;
use Omnipay\Tests\TestCase;

class PaymentCancelRequestTest extends TestCase
{
    public function testSend()
    {
        // $request = new CheckoutVoidRequest(
        //     new \Omnipay\Common\Http\Client(new \GuzzleHttp\Client()),
        //     $this->getHttpRequest()
        // );
        $request = new PaymentCancelRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->setMockHttpResponse('CancelPaymentSuccess.txt');

        $request->initialize(array_merge([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
            'testMode' => 1,
        ], [
            'payment' => 'payment_00778be57b9087180596678817973e61',
        ]));

        $response = $request->send();

        self::assertTrue($response->isSuccessful());
        self::assertEquals('payment_00778be57b9087180596678817973e61', $response->getTransactionReference());
    }
}
