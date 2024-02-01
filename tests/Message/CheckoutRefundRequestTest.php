<?php

namespace Omnipay\Rapyd\Tests\Message;


use Omnipay\Rapyd\Message\CheckoutRefundRequest;
use Omnipay\Tests\TestCase;

class CheckoutRefundRequestTest extends TestCase
{
    public function testCreateRefundParameters()
    {
        $request = new CheckoutRefundRequest($this->getHttpClient(), $this->getHttpRequest());

        $request->initialize(array_merge([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
            'testMode' => 1,
        ], [
            'amount' => 100,
            'currency' => 'USD',
            'transaction_id' => 'merchant reference id',
            'transaction_reference' => 'transaction reference id',
            'reason' => 'reason',
        ]));

        $data = $request->getData();

        self::assertEquals([
            'amount' => '100.00',
            'currency' => 'USD',
            'merchant_reference_id' => 'merchant reference id',
            'payment' => 'transaction reference id',
            'reason' => 'reason',
        ], $data);
    }
}
