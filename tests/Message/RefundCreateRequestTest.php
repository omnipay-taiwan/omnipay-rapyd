<?php

namespace Omnipay\Rapyd\Tests\Message;

use Omnipay\Rapyd\Message\RefundCreateRequest;
use Omnipay\Tests\TestCase;

class RefundCreateRequestTest extends TestCase
{
    public function testCreateRefundParameters()
    {
        $request = new RefundCreateRequest($this->getHttpClient(), $this->getHttpRequest());

        $request->initialize(array_merge([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
            'testMode' => 1,
        ], [
            'amount' => 100,
            'currency' => 'USD',
            'transaction_id' => '0912-2021',
            'transaction_reference' => 'transaction reference id',
            'reason' => 'reason',
        ]));

        $data = $request->getData();

        self::assertEquals([
            'amount' => '100.00',
            'currency' => 'USD',
            'merchant_reference_id' => '0912-2021',
            'payment' => 'transaction reference id',
            'reason' => 'reason',
        ], $data);
    }

    public function testSendAndComplete()
    {
        // $request = new CheckoutRefundRequest(
        //     new \Omnipay\Common\Http\Client(new \GuzzleHttp\Client()),
        //     $this->getHttpRequest()
        // );
        $request = new RefundCreateRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->setMockHttpResponse('CreateRefundSuccessAndStatusIsCompleted.txt');

        $request->initialize(array_merge([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
            'testMode' => 1,
        ], [
            'transaction_id' => '0912-2021',
            'payment' => 'payment_29bd65de02c9a6f558599b2348fe4b1d',
        ]));

        $response = $request->send();

        self::assertTrue($response->isSuccessful());
        self::assertEquals('0912-2021', $response->getTransactionId());
        self::assertEquals('refund_213d6b1987bfc58d27816b805e0506d8', $response->getTransactionReference());
    }
}
