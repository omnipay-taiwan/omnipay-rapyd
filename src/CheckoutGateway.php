<?php

namespace Omnipay\Rapyd;

use Omnipay\Common\AbstractGateway;
use Omnipay\Rapyd\Message\AuthorizeRequest;
use Omnipay\Rapyd\Message\CheckoutPurchaseRequest;
use Omnipay\Rapyd\Traits\HasRapyd;

/**
 * Gateway
 */
class CheckoutGateway extends AbstractGateway
{
    use HasRapyd;

    public function getName()
    {
        return 'Rapyd_Checkout';
    }

    public function getDefaultParameters()
    {
        return [
            'access_key' => '',
            'secret_key' => '',
            'testMode' => false,
        ];
    }

    public function authorize(array $options = [])
    {
        return $this->createRequest(AuthorizeRequest::class, $options);
    }

    public function purchase(array $options = [])
    {
        return $this->createRequest(CheckoutPurchaseRequest::class, $options);
    }
}
