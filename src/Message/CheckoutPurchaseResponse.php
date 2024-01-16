<?php

namespace Omnipay\Rapyd\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

class CheckoutPurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->data['data']['redirect_url'];
    }

    public function getTransactionId()
    {
        return $this->data['data']['payment']['merchant_reference_id'];
    }

    public function getTransactionReference()
    {
        return $this->data['data']['id'];
    }
}
