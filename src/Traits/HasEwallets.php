<?php

namespace Omnipay\Rapyd\Traits;

trait HasEwallets
{
    /**
     * An array of objects that represent wallets that the refund is charged to.
     *
     * @param  array  $value
     */
    public function setEwallets($value)
    {
        return $this->setParameter('ewallets', $value);
    }

    /**
     * @return ?array
     */
    public function getEwallets()
    {
        return $this->getParameter('ewallets');
    }
}
