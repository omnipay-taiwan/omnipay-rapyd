<?php

namespace Omnipay\Rapyd\Message;

use Omnipay\Common\Message\NotificationInterface;

class CheckoutAcceptNotificationRequest extends AbstractRequest implements NotificationInterface
{
    public function getData()
    {
        var_dump($this->httpRequest->headers);

        return $this->httpRequest->toArray();
    }

    public function sendData($data)
    {
        return $this->response = new CheckoutAcceptNotificationResponse($this, $data);
    }

    public function getTransactionStatus()
    {
        // TODO: Implement getTransactionStatus() method.
    }

    public function getMessage()
    {
        // TODO: Implement getMessage() method.
    }
}
