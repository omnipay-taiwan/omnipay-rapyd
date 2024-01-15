<?php

namespace Omnipay\Rapyd\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Response
 */
class Response extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['success']);
    }

    public function getTransactionReference()
    {
        if (isset($this->data['reference'])) {
            return $this->data['reference'];
        }
    }

}
