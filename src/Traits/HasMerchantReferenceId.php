<?php

namespace Omnipay\Rapyd\Traits;

trait HasMerchantReferenceId
{
    /**
     * Identifier defined by the client for reference purposes. Limit: 45 characters.
     * @param  string  $value
     */
    public function setMerchantReferenceId($value)
    {
        return $this->setTransactionId($value);
    }

    /**
     * @return ?string
     */
    public function getMerchantReferenceId()
    {
        return $this->getTransactionId();
    }
}
