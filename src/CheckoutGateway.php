<?php

namespace Omnipay\Rapyd;

use Omnipay\Common\AbstractGateway;
use Omnipay\Rapyd\Message\AuthorizeRequest;
use Omnipay\Rapyd\Message\CheckoutAcceptNotificationRequest;
use Omnipay\Rapyd\Message\CheckoutFetchTransactionRequest;
use Omnipay\Rapyd\Message\CheckoutPurchaseRequest;
use Omnipay\Rapyd\Message\CheckoutRefundRequest;
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
            'accessKey' => '',
            'secretKey' => '',
            'testMode' => false,
        ];
    }

    public function purchase(array $options = [])
    {
        return $this->createRequest(CheckoutPurchaseRequest::class, $options);
    }

    public function fetchTransaction(array $options)
    {
        return $this->createRequest(CheckoutFetchTransactionRequest::class, $options);
    }

    public function acceptNotification(array $options = [])
    {
        return $this->createRequest(CheckoutAcceptNotificationRequest::class, $options);
    }

    public function refund(array $options = [])
    {
        return $this->createRequest(CheckoutRefundRequest::class, $options);
    }
}
