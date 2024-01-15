<?php

namespace Omnipay\Rapyd;

use Omnipay\Common\AbstractGateway;
use Omnipay\Rapyd\Message\AuthorizeRequest;

/**
 * Gateway
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Rapyd';
    }

    public function getDefaultParameters()
    {
        return [
            'key' => '',
            'testMode' => false,
        ];
    }

    public function getKey()
    {
        return $this->getParameter('key');
    }

    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }

    /**
     * @return Message\AuthorizeRequest
     */
    public function authorize(array $options = [])
    {
        return $this->createRequest(AuthorizeRequest::class, $options);
    }
}
