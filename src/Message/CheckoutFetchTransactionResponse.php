<?php

namespace Omnipay\Rapyd\Message;

class CheckoutFetchTransactionResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        /**
         * status
         * Status of the hosted page. One of the following:
         * - NEW - The hosted page was created.
         * - DON - Done. The payment was completed.
         * - EXP - The hosted page expired.
         * - INP - Creation of the payment is still in progress.
         * - DEC - Rapyd Protect blocked the payment.
         */

        return $this->getCode() === 'DON';
    }

    public function getCode()
    {
        return $this->data['data']['status'];
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
