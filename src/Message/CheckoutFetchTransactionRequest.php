<?php

namespace Omnipay\Rapyd\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Rapyd\ClientHelper;
use Omnipay\Rapyd\Signature;
use Omnipay\Rapyd\Traits\HasRapyd;

class CheckoutFetchTransactionRequest extends AbstractRequest
{
    use HasRapyd;

    /**
     * ID of the checkout page. String starting with checkout_.
     *
     * @param  string  $value
     */
    public function setCheckout($value)
    {
        return $this->setTransactionReference($value);
    }

    /**
     * @return string
     */
    public function getCheckout()
    {
        return $this->getTransactionReference();
    }

    public function getData()
    {
        return [
            'checkout' => $this->getTransactionReference(),
        ];
    }

    /**
     * @throws InvalidResponseException
     */
    public function sendData($data)
    {
        $uri = $this->getEndpoint().'/v1/checkout/'.$data['checkout'];
        $clientHelper = new ClientHelper($this->httpClient, Signature::create($this));
        $result = $clientHelper->request('GET', $uri);

        return $this->response = new CheckoutFetchTransactionResponse($this, $result);
    }
}
