<?php

namespace Omnipay\Rapyd\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Rapyd\ClientHelper;
use Omnipay\Rapyd\Signature;
use Omnipay\Rapyd\Traits\HasPaymentId;
use Omnipay\Rapyd\Traits\HasRapyd;

class PaymentCancelRequest extends AbstractRequest
{
    use HasPaymentId;
    use HasRapyd;

    public function getData()
    {
        return array_filter([
            'payment' => $this->getPayment(),
        ], static function ($value) {
            return $value !== null && $value !== '';
        });
    }

    /**
     * @throws InvalidRequestException
     */
    public function sendData($data)
    {
        $uri = $this->getEndpoint().'/v1/payments/'.$data['payment'];
        $signature = new Signature($this->getAccessKey(), $this->getSecretKey());
        $clientHelper = new ClientHelper($this->httpClient, $signature);
        $result = $clientHelper->request('POST', $uri, $data);

        return $this->response = new PaymentCancelResponse($this, $result);
    }
}
