<?php

namespace Omnipay\Rapyd\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Rapyd\Signature;
use Omnipay\Rapyd\Traits\HasRapyd;

class WebhookRequest extends AbstractRequest implements NotificationInterface
{
    use HasRapyd;

    /**
     * @throws InvalidResponseException
     */
    public function getData()
    {
        if (! Signature::create($this)->checkRequest($this->httpRequest)) {
            throw new InvalidResponseException('Invalid Signature');
        }

        return json_decode(trim($this->httpRequest->getContent()), true);
    }

    public function sendData($data)
    {
        return $this->response = new WebhookResponse($this, $data);
    }

    public function getTransactionId()
    {
        return $this->getNotificationResponse()->getTransactionId();
    }

    public function getTransactionReference()
    {
        return $this->getNotificationResponse()->getTransactionReference();
    }

    public function getTransactionStatus()
    {
        return $this->getNotificationResponse()->getTransactionStatus();
    }

    public function getMessage()
    {
        return $this->getNotificationResponse()->getMessage();
    }

    /**
     * @return WebhookResponse
     */
    private function getNotificationResponse()
    {
        return ! $this->response ? $this->send() : $this->response;
    }
}
