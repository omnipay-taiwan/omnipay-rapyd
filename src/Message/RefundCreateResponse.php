<?php

namespace Omnipay\Rapyd\Message;

class RefundCreateResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return $this->getCode() === 'Completed';
    }

    /**
     * status
     * Indicates the status of the refund operation. One of the following values:
     * - Completed - The refund was complete.
     * - Error - The refund failed since the payment object on which the refund is based is not in closed status.
     * - Rejected - The refund was not made because of an internal error.
     * - Pending - The request created a refund object on the Rapyd platform, but the refund is not yet complete. For example, the refund is for a payment method that requires a customer action, such as cash, bank redirect or bank transfer.
     */
    public function getCode()
    {
        return $this->data['data']['status'];
    }

    public function getTransactionId()
    {
        return $this->data['data']['merchant_reference_id'];
    }

    public function getTransactionReference()
    {
        return $this->data['data']['id'];
    }
}
