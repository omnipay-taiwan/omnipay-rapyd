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
            'access_key' => '',
            'secret_key' => '',
            'testMode' => false,
        ];
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

    /**
     * @return Message\AuthorizeRequest
     */
    public function authorize(array $options = [])
    {
        return $this->createRequest(AuthorizeRequest::class, $options);
    }
}
