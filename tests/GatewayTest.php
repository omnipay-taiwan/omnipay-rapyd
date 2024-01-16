<?php

namespace Omnipay\Rapyd\Test;

use Omnipay\Rapyd\Gateway;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /** @var Gateway */
    protected $gateway;

    protected $options = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->initialize([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
        ]);

        $this->options = [
            'amount' => '10.00',
            'card' => $this->getValidCard(),
        ];
    }

    public function testAuthorize()
    {
        $this->setMockHttpResponse('AuthorizeSuccess.txt');

        $response = $this->gateway->authorize($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('1234', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }
}
