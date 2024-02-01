<?php

namespace Omnipay\Rapyd\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Rapyd\Traits\HasEwallets;
use Omnipay\Rapyd\Traits\HasMerchantReferenceId;
use Omnipay\Rapyd\Traits\HasMetadata;
use Omnipay\Rapyd\Traits\HasPaymentId;
use Omnipay\Rapyd\Traits\HasRapyd;

class CheckoutRefundRequest extends AbstractRequest
{
    use HasRapyd;
    use HasMerchantReferenceId;
    use HasEwallets;
    use HasMetadata;
    use HasPaymentId;

    public function setEwallets($value)
    {
        return $this->setParameter('ewallets', $value);
    }

    public function getEwallets()
    {
        return $this->getParameter('ewallets');
    }

    public function setReason($value)
    {
        return $this->setParameter('reason', $value);
    }

    public function getReason()
    {
        return $this->getParameter('reason');
    }

    /**
     * @throws InvalidRequestException
     */
    public function getData()
    {
        return array_filter([
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'merchant_reference_id' => $this->getTransactionId(),
            'payment' => $this->getPayment(),
            'reason' => $this->getReason(),
        ], static function ($value) {
            return $value !== null && $value !== '';
        });
    }

    public function sendData($data)
    {
        // TODO: Implement sendData() method.
    }
}
