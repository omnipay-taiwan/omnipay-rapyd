<?php

namespace Omnipay\Rapyd\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Rapyd\ClientHelper;
use Omnipay\Rapyd\Signature;
use Omnipay\Rapyd\Traits\HasEwallets;
use Omnipay\Rapyd\Traits\HasMerchantReferenceId;
use Omnipay\Rapyd\Traits\HasMetadata;
use Omnipay\Rapyd\Traits\HasPaymentId;
use Omnipay\Rapyd\Traits\HasRapyd;

class RefundCreateRequest extends AbstractRequest
{
    use HasEwallets;
    use HasMerchantReferenceId;
    use HasMetadata;
    use HasPaymentId;
    use HasRapyd;

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

    /**
     * @throws InvalidRequestException
     */
    public function sendData($data)
    {
        $uri = $this->getEndpoint().'/v1/refunds/';
        $signature = new Signature($this->getAccessKey(), $this->getSecretKey());
        $clientHelper = new ClientHelper($this->httpClient, $signature);
        $result = $clientHelper->request('POST', $uri, $data);

        return $this->response = new RefundCreateResponse($this, $result);
    }
}
