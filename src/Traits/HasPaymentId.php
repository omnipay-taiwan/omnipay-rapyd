<?php

namespace Omnipay\Rapyd\Traits;

trait HasPaymentId
{
    /**
     * ID of the payment object that the refund is charged against. String starting with payment_.
     * @param  string  $value
     * @return self
     */
    public function setPayment($value)
    {
        return $this->setTransactionReference($value);
    }

    /**
     * @return string
     */
    public function getPayment()
    {
        return $this->getTransactionReference();
    }
}
