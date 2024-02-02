<?php

namespace Omnipay\Rapyd;

use Omnipay\Common\Helper;
use Omnipay\Common\ParametersTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

class AccountFundingTransaction
{
    use ParametersTrait;

    public function __construct(?array $parameters = null)
    {
        $this->initialize($parameters);
    }

    public function initialize(?array $parameters = null)
    {
        $this->parameters = new ParameterBag;

        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * ID of a Rapyd wallet.
     * String starting with ewallet_.
     * The wallet contact must include first name, last name, country, and the address object, which must contain line_1 (street and number), city, and zip (postal code).
     * The cardholder's first name, last name, and country must match the values of the wallet contact.
     *
     * @param  string  $value
     */
    public function setEwallet($value)
    {
        $this->setParameter('ewallet', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getEwallet()
    {
        return $this->getParameter('ewallet');
    }

    /**
     * Array of strings. One or more card payment method types that support AFT.
     *
     * @param  array  $value
     */
    public function setPaymentMethodTypes($value)
    {
        $this->setParameter('payment_method_types', $value);

        return $this;
    }

    /**
     * @return ?array
     */
    public function getPaymentMethodTypes()
    {
        return $this->getParameter('payment_method_types');
    }
}
