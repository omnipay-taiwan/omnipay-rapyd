<?php

namespace Omnipay\Rapyd;

use Omnipay\Common\Helper;
use Omnipay\Common\ParametersTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

class TransactionFee
{
    use ParametersTrait;

    public function __construct(array $parameters = null)
    {
        $this->initialize($parameters);
    }

    public function initialize(array $parameters = null)
    {
        $this->parameters = new ParameterBag;

        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * Specifies how the fee is calculated. One of the following:
     * - net - The fee is deducted from the amount paid. For example, in a payment of $100 with a fee of 5%, the recipient receives $95.00 and the $5.00 fee goes to the client wallet.
     * - gross - The fee is added to the amount paid. For example, for a transaction of $100 with a fee of 5%, the sender pays $105.00.
     * @param  string  $value
     * @return TransactionFee
     */
    public function setCalcType($value)
    {
        return $this->setParameter('calc_type', $value);
    }

    /**
     * @return ?string
     */
    public function getCalcType()
    {
        return $this->getParameter('calc_type');
    }

    /**
     * One of the following:
     * - percentage - A percentage of the transaction amount. For example, 5 percent is represented by value=5.
     * - absolute - A fixed amount.
     * @param  string  $value
     */
    public function setFeeType($value)
    {
        return $this->setParameter('fee_type', $value);
    }

    /**
     * @return ?string
     */
    public function getFeeType()
    {
        return $this->getParameter('fee_type');
    }

    /**
     * @param  numeric  $value
     */
    public function setValue($value)
    {
        return $this->setParameter('value', $value);
    }

    public function getValue()
    {
        return $this->getParameter('value');
    }
}
