<?php

namespace Omnipay\Rapyd;

use Omnipay\Common\Helper;
use Omnipay\Common\ParametersTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

class CustomElements
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
     * Determines whether the customer is asked to fill in the billing address.
     * Relevant when a card payment method is selected.
     * - true - The address fields appear on the checkout page.
     * - false - The address fields appear only if the country is US, GB or CA.
     * Default value: false
     *
     * @param  bool  $value
     */
    public function setBillingAddressCollect($value)
    {
        return $this->setParameter('billing_address_collect', $value);
    }

    /**
     * @return ?bool
     */
    public function getBillingAddressCollect()
    {
        return $this->getParameter('billing_address_collect');
    }

    /**
     * The name of the card owner, printed on the front of the card.
     *
     * @param  string  $value
     */
    public function setCardholderName($value)
    {
        return $this->setParameter('cardholder_name', $value);
    }

    /**
     * @return ?string
     */
    public function getCardholderName()
    {
        return $this->getParameter('cardholder_name');
    }

    /**
     * Determines whether the checkout page displays the payment description.
     * - true - The payment description appears.
     * - false - The payment description does not appear.
     * Default value: false
     * Relevant when description is passed in the [Create Checkout Page](https://docs.rapyd.net/en/create-checkout-page.html) request.
     *
     * @param  bool  $value
     */
    public function setDisplayDescription($value)
    {
        return $this->setParameter('display_description', $value);
    }

    /**
     * @return ?bool
     */
    public function getDisplayDescription()
    {
        return $this->getParameter('display_description');
    }

    /**
     * Determines whether the checkout page displays multiple currency options for a payment.
     * - true - Multiple currency options appear.
     * - false - Currency options do not appear.
     * Default value: false
     *
     * When the customer selects the requested currency, the checkout page displays the following information:
     * - The original amount and currency.
     * - The converted amount in the requested currency.
     * - The exchange rate.
     *
     * Relevant when:
     * - The [Create Checkout Page](https://docs.rapyd.net/en/create-checkout-page.html) request passes requested_currency.
     * - fixed_side is buy.
     * - One or more payment methods support the values for currency and requested_currency.
     *
     * @param  bool  $value
     */
    public function setDynamicCurrencyConversion($value)
    {
        return $this->setParameter('dynamic_currency_conversion', $value);
    }

    /**
     * @return ?bool
     */
    public function getDynamicCurrencyConversion()
    {
        return $this->getParameter('dynamic_currency_conversion');
    }

    /**
     * Reserved.
     *
     * @param  string  $value
     */
    public function setMerchantColor($value)
    {
        return $this->setParameter('merchant_color', $value);
    }

    /**
     * @return ?string
     */
    public function getMerchantColor()
    {
        return $this->getParameter('merchant_color');
    }

    /**
     * In a payment with FX where fixed_side=buy, determines whether the buyer's currency and the exchange rate appear.
     * One of the following:
     * - true - The currency and the exchange rate are hidden.
     * - false - The currency and the exchange rate appear.
     * Default value: false
     *
     * @param  bool  $value
     */
    public function setMerchantCurrencyOnly($value)
    {
        return $this->setParameter('merchant_currency_only', $value);
    }

    /**
     * @return ?bool
     */
    public function getMerchantCurrencyOnly()
    {
        return $this->getParameter('merchant_currency_only');
    }

    /**
     * Determines whether payment fees appear on the checkout page.
     * - true - Payment fees appear when the payment_fees object is set in the Create Checkout Page request.
     * - false - Payment fees do not appear.
     * Default value: true
     *
     * @param  bool  $value
     */
    public function setPaymentFeesDisplay($value)
    {
        return $this->setParameter('payment_fees_display', $value);
    }

    /**
     * @return ?bool
     */
    public function getPaymentFeesDisplay()
    {
        return $this->getParameter('payment_fees_display');
    }

    /**
     * Determines whether the save card checkbox is checked by default.
     * - true - The save card checkbox is checked.
     * - false - The save card checkbox is cleared.
     * Default value: false
     *
     * Relevant when customer_id is passed in the Create Checkout Page request.
     *
     * @param  bool  $value
     */
    public function setSaveCardDefault($value)
    {
        return $this->setParameter('save_card_default', $value);
    }

    /**
     * @return ?bool
     */
    public function getSaveCardDefault()
    {
        return $this->getParameter('save_card_default');
    }
}
