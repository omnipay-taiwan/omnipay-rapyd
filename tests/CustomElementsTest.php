<?php

namespace Omnipay\Rapyd\Tests;

use Omnipay\Rapyd\CustomElements;
use PHPUnit\Framework\TestCase;

class CustomElementsTest extends TestCase
{
    public function testCustomElements()
    {
        $customElements = new CustomElements();
        $customElements->setBillingAddressCollect(true);
        $customElements->setCardholderName('holder name');
        $customElements->setDisplayDescription(true);
        $customElements->setDynamicCurrencyConversion(true);
        $customElements->setMerchantColor('red');
        $customElements->setMerchantCurrencyOnly(true);
        $customElements->setPaymentFeesDisplay(true);
        $customElements->setSaveCardDefault(false);

        self::assertEquals([
            'billing_address_collect' => true,
            'cardholder_name' => 'holder name',
            'display_description' => true,
            'dynamic_currency_conversion' => true,
            'merchant_color' => 'red',
            'merchant_currency_only' => true,
            'payment_fees_display' => true,
            'save_card_default' => false,
        ], $customElements->getParameters());
    }
}
