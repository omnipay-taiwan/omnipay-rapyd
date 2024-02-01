<?php

namespace Omnipay\Rapyd\Message;

class CheckoutFetchTransactionResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        $payment = $this->data['data']['payment'];

        return $payment['captured'] === true && $payment['refunded'] === false;
    }

    /**
     * status
     * Indicates the status of the payment. One of the following:
     * - ACT - Active and awaiting completion of 3DS or capture. Can be updated.
     * - CAN - Canceled by the client or the customer's bank.
     * - CLO - Closed and paid.
     * - ERR - Error. An attempt was made to create or complete a payment, but it failed.
     * - EXP - The payment has expired.
     * - REV - Reversed by Rapyd. See cancel_reason.
     */
    public function getCode()
    {
        return $this->data['data']['payment']['status'];
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
