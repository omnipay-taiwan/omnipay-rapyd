<?php

namespace Omnipay\Rapyd;

use Omnipay\Common\Helper;
use Omnipay\Common\ParametersTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

class PaymentFees
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
     * Describes the fee for processing the transaction.
     *
     * @param  TransactionFee  $value
     */
    public function setTransactionFee($value)
    {
        return $this->setParameter('transaction_fee', $value);
    }

    /**
     * @return ?TransactionFee
     */
    public function getTransactionFee()
    {
        return $this->getParameter('transaction_fee');
    }

    /**
     * Describes the fees for processing the currency exchange. Relevant to payments with FX.
     *
     * @param  FxFee  $value
     * @return PaymentFees
     */
    public function setFxFee($value)
    {
        return $this->setParameter('fx_fee', $value);
    }

    /**
     * @return FxFee
     */
    public function getFxFee()
    {
        return $this->getParameter('fx_fee');
    }

    /**
     * The total gross fees for the transaction, in units defined by currency_code.
     *
     * @param  numeric  $value
     */
    public function setGrossFees($value)
    {
        return $this->setParameter('gross_fees', $value);
    }

    /**
     * @return ?numeric
     */
    public function getGrossFees()
    {
        return $this->getParameter('gross_fees');
    }

    /**
     * The total net fees for the transaction, in units defined by merchant_requested_currency.
     *
     * @param  numeric  $value
     */
    public function setNetFees($value)
    {
        return $this->setParameter('net_fees', $value);
    }

    /**
     * @return ?numeric
     */
    public function getNetFees()
    {
        return $this->getParameter('net_fees');
    }

    /**
     * The amount of the fee.
     *
     * @param  numeric  $value
     */
    public function setTotalMerchantFees($value)
    {
        return $this->setParameter('total_merchant_fees', $value);
    }

    /**
     * @return ?numeric
     */
    public function getTotalMerchantFees()
    {
        return $this->getParameter('total_merchant_fees');
    }
}
