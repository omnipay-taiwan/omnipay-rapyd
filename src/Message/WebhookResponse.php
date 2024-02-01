<?php

namespace Omnipay\Rapyd\Message;

use Omnipay\Common\Message\NotificationInterface;

class WebhookResponse extends AbstractResponse implements NotificationInterface
{
    public function getTransactionStatus()
    {
        if ($this->isSuccessful()) {
            return NotificationInterface::STATUS_COMPLETED;
        }

        if ($this->isCancelled()) {
            return NotificationInterface::STATUS_FAILED;
        }

        return NotificationInterface::STATUS_PENDING;
    }

    public function isSuccessful()
    {
        return $this->getCode() === 'CLO' && $this->data['data']['refunded'] === false;
    }

    public function isCancelled()
    {
        return $this->getCode() === 'CAN' || $this->data['data']['refunded'] === true;
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
        return $this->data['data']['status'];
    }

    public function getTransactionReference()
    {
        return $this->data['data']['id'];
    }

    public function getTransactionId()
    {
        return $this->data['data']['merchant_reference_id'];
    }
}
