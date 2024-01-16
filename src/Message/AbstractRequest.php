<?php

namespace Omnipay\Rapyd\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * Abstract Request
 *
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    protected $liveEndpoint = 'https://api.rapyd.net';
    protected $testEndpoint = 'https://sandboxapi.rapyd.net';

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function getAccessKey()
    {
        return $this->getParameter('access_key');
    }

    public function setAccessKey($value)
    {
        return $this->setParameter('access_key', $value);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secret_key');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secret_key', $value);
    }

    public function sendData($data)
    {
        $url = $this->getEndpoint().'?'.http_build_query($data, '', '&');
        $response = $this->httpClient->request('GET', $url);

        $data = json_decode($response->getBody(), true);

        return $this->createResponse($data);
    }

    protected function getBaseData()
    {
        return [
            'transaction_id' => $this->getTransactionId(),
            'expire_date' => $this->getCard()->getExpiryDate('mY'),
            'start_date' => $this->getCard()->getStartDate('mY'),
        ];
    }

    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }
}
