<?php

namespace Omnipay\Rapyd\Traits;

trait HasMetadata
{
    /**
     * A JSON object defined by the client. See [Metadata](https://docs.rapyd.net/en/metadata.html).
     * @param  array  $value
     */
    public function setMetadata($value)
    {
        return $this->setParameter('metadata', $value);
    }

    /**
     * @return ?array
     */
    public function getMetadata()
    {
        return $this->getParameter('metadata');
    }

}
