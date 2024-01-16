<?php

namespace Omnipay\Rapyd;

use Omnipay\Common\AbstractGateway;
use Omnipay\Rapyd\Message\AuthorizeRequest;
use Omnipay\Rapyd\Traits\HasRapyd;

/**
 * Gateway
 */
class Gateway extends AbstractGateway
{
    use HasRapyd;

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

    /**
     * @return Message\AuthorizeRequest
     */
    public function authorize(array $options = [])
    {
        return $this->createRequest(AuthorizeRequest::class, $options);
    }
}
