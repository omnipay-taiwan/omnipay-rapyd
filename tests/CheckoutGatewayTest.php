<?php

namespace Omnipay\Rapyd\Tests;

use Omnipay\Rapyd\CheckoutGateway;
use Omnipay\Tests\GatewayTestCase;

class CheckoutGatewayTest extends GatewayTestCase
{
    /** @var CheckoutGateway */
    protected $gateway;

    protected $options = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new CheckoutGateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->initialize([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
        ]);

        $this->options = [];
    }
}
