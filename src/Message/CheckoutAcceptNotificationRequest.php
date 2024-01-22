<?php

namespace Omnipay\Rapyd\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Rapyd\Traits\HasRapyd;

class CheckoutAcceptNotificationRequest extends AbstractRequest implements NotificationInterface
{
    use HasRapyd;

    /**
     * @throws InvalidResponseException
     */
    public function getData()
    {
        $urlPath = $this->httpRequest->getUri();
        $timestamp = $this->httpRequest->headers->get('timestamp');
        $salt = $this->httpRequest->headers->get('salt');
        $signature = $this->httpRequest->headers->get('signature');
        $content = trim($this->httpRequest->getContent());

        $signed = base64_encode(hash_hmac("sha256",
                implode('',
                    [
                        $urlPath,
                        $salt,
                        $timestamp,
                        $this->getAccessKey(),
                        $this->getSecretKey(),
                        $content,
                    ]
                ),
                $this->getSecretKey())
        );

        if ($signature !== $signed) {
            throw new InvalidResponseException('signature is invalid');
        }

        return json_decode($content, true);
    }

    public function sendData($data)
    {
        return $this->response = new CheckoutAcceptNotificationResponse($this, $data);
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
     * @return CheckoutAcceptNotificationResponse
     */
    private function getNotificationResponse()
    {
        return ! $this->response ? $this->send() : $this->response;
    }
}
