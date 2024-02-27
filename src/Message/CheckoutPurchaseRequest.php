<?php

namespace Omnipay\Rapyd\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Rapyd\AccountFundingTransaction;
use Omnipay\Rapyd\ClientHelper;
use Omnipay\Rapyd\CustomElements;
use Omnipay\Rapyd\Item;
use Omnipay\Rapyd\PaymentFees;
use Omnipay\Rapyd\Signature;
use Omnipay\Rapyd\Traits\HasEwallets;
use Omnipay\Rapyd\Traits\HasMerchantReferenceId;
use Omnipay\Rapyd\Traits\HasMetadata;
use Omnipay\Rapyd\Traits\HasRapyd;

class CheckoutPurchaseRequest extends AbstractRequest
{
    use HasEwallets;
    use HasMerchantReferenceId;
    use HasMetadata;
    use HasRapyd;

    /**
     * Details of an account funding transaction (AFT), which transfers funds from a card to a cardholder's wallet.
     * You can transfer funds from a card directly to the cardholder's own wallet.
     * You can also transfer the funds indirectly through the company wallet of a licensed business entity that manages the customer's wallet.
     * The business forwards the funds to the customer's wallet.
     * When a business transfers the funds, customer is required in the root of the request.
     * The customer address must include phone number, street (line_1), city, country, and zip (postal code).
     * This feature is in beta testing.
     * Relevant to payment method types that support AFT.
     * To enable this feature, contact [Rapyd Client Support](https://dashboard.rapyd.net/settings/support-center/open).
     * Contains the following fields:
     *
     * @param  AccountFundingTransaction  $value
     */
    public function setAccountFundingTransaction($value)
    {
        return $this->setParameter('account_funding_transaction', $value);
    }

    /**
     * @return ?AccountFundingTransaction
     */
    public function getAccountFundingTransaction()
    {
        return $this->getParameter('account_funding_transaction');
    }

    /**
     * URL where the customer is redirected after pressing Back to Website to exit the hosted page.
     * This URL overrides the merchant_website URL. Does not support localhost URLs.
     *
     * @param  string  $value
     * @return self
     */
    public function setCancelCheckoutUrl($value)
    {
        return $this->setCancelUrl($value);
    }

    /**
     * @return ?string
     */
    public function getCancelCheckoutUrl()
    {
        return $this->getCancelUrl();
    }

    /**
     * Determines when the payment is processed for capture. Relevant to card payments.
     * true - Capture the payment immediately.
     * false - Authorize the payment, then capture some or all of the payment at a later time,
     *         when the merchant runs the [Capture Payment](https://docs.rapyd.net/en/capture-payment.html) method.
     * Default value: true
     *
     * @param  bool  $value
     */
    public function setCapture($value)
    {
        return $this->setParameter('capture', $value);
    }

    /**
     * @return ?bool
     */
    public function getCapture()
    {
        return $this->getParameter('capture');
    }

    /**
     * URL where the customer is redirected after pressing Finish to exit the hosted page.
     * This URL overrides the merchant_website URL. Does not support localhost URLs.
     *
     * @param  string  $value
     */
    public function setCompleteCheckoutUrl($value)
    {
        return $this->setReturnUrl($value);
    }

    /**
     * @return ?string
     */
    public function getCompleteCheckoutUrl()
    {
        return $this->getReturnUrl();
    }

    /**
     * URL where the customer is redirected when payment is successful, after returning from an external page such as a 3DS page.
     * Does not support localhost URLs.
     *
     * @param  string  $value
     */
    public function setCompletePaymentUrl($value)
    {
        return $this->setParameter('complete_payment_url', $value);
    }

    /**
     * @return ?string
     */
    public function getCompletePaymentUrl()
    {
        return $this->getParameter('complete_payment_url');
    }

    /**
     * Defines the currency for the amount received by the seller (merchant).
     * Three-letter ISO 4217 code.
     * In FX transactions, when fixed_side is buy, it is the currency received by the merchant.
     * When fixed_side is sell, it is the currency charged to the buyer.
     *
     * @param  string  $value
     */
    public function setCountry($value)
    {
        return $this->setParameter('country', $value);
    }

    /**
     * @return ?string
     */
    public function getCountry()
    {
        return $this->getParameter('country');
    }

    /**
     * Describes customizations of the page as it appears to the customer.
     *
     * @param  CustomElements  $value
     */
    public function setCustomElements($value)
    {
        return $this->setParameter('custom_elements', $value);
    }

    /**
     * @return ?CustomElements
     */
    public function getCustomElements()
    {
        return $this->getParameter('custom_elements');
    }

    /**
     * ID of the customer. String starting with cus_.
     * When used, the customer has the option to save card details for future purchases.
     * This field is for some payment methods and for all company-type wallets.
     *
     * @param  string  $value
     */
    public function setCustomer($value)
    {
        return $this->setParameter('customer', $value);
    }

    /**
     * @return ?string
     */
    public function getCustomer()
    {
        return $this->getParameter('customer');
    }

    /**
     * URL where the customer is redirected when payment is not successful, after returning from an external page, such as a 3DS page.
     * Does not support localhost URLs.
     *
     * @param  string  $value
     */
    public function setErrorPaymentUrl($value)
    {
        return $this->setParameter('error_payment_url', $value);
    }

    /**
     * @return ?string
     */
    public function getErrorPaymentUrl()
    {
        return $this->getParameter('error_payment_url');
    }

    /**
     * Determines whether the payment is held in escrow for later release.
     *
     * @param  bool  $value
     */
    public function setEscrow($value)
    {
        return $this->setParameter('escrow', $value);
    }

    /**
     * @return ?string
     */
    public function getEscrow()
    {
        return $this->getParameter('escrow');
    }

    /**
     * Determines the number of days after creation of the payment that funds are released from escrow.
     * Funds are released at 5:00 pm GMT on the day indicated. Integer, range: 1-90.
     *
     * @param  int  $value
     */
    public function setEscrowReleaseDays($value)
    {
        return $this->setParameter('escrow_release_days', $value);
    }

    /**
     * @return ?int
     */
    public function getEscrowReleaseDays()
    {
        return $this->getParameter('escrow_release_days');
    }

    /**
     * ID of the wallet that the money is paid into.
     * String starting with ewallet_.
     * Relevant for specifying a single wallet in the request.
     *
     * @param  string  $value
     */
    public function setEwallet($value)
    {
        return $this->setParameter('ewallet', $value);
    }

    /**
     * @return ?string
     */
    public function getEwallet()
    {
        return $this->getParameter('ewallet');
    }

    /**
     * Time when the payment expires if it is not completed, in Unix time.
     * When both expiration and payment_expiration are set, the payment expires at the earlier time.
     * Default value: 14 days after creation of the checkout page.
     *
     * @param  int  $value
     */
    public function setExpiration($value)
    {
        return $this->setParameter('expiration', $value);
    }

    /**
     * @return ?int
     */
    public function getExpiration()
    {
        return $this->getParameter('expiration');
    }

    /**
     * Indicates whether the FX rate is fixed for the buy side (seller) or for the sell side (buyer). One of the following values:
     * - buy - The checkout page shows the currency that the seller (merchant) receives for goods or services. For example, a US-based merchant wants to charge 100 USD. The buyer (customer) pays the amount in MXN that converts to 100 USD.
     * - sell - The checkout page shows the currency that the buyer is charged with to purchase goods or services from the seller. For example, a US-based merchant wants to charge a buyer 2,000 MXN and will accept whatever amount in USD that is converted from 2,000 MXN.
     * Default value: buy
     *
     * @param  string  $value
     */
    public function setFixedSide($value)
    {
        return $this->setParameter('fixed_side', $value);
    }

    /**
     * @return ?string
     */
    public function getFixedSide()
    {
        return $this->getParameter('fixed_side');
    }

    /**
     * Determines the default language of the hosted page. For a list of values, see [List Supported Languages](https://docs.rapyd.net/en/list-supported-languages.html).
     * - When this parameter is null, the language of the user's browser is used.
     * - If the language of the user's browser cannot be determined, the default language is English.
     *
     * @param  string  $value
     */
    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    /**
     * @return ?string
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * Object that contains payment method fields that the merchant fills in.
     * Can include a payment_method_options object.
     * The fields are not displayed to the customer on the hosted page.
     * To get the fields that the merchant and customer each fill in for a payment method, use [Get Payment Method Required Fields](https://docs.rapyd.net/en/get-payment-method-required-fields.html).
     *
     * @param  array  $value
     */
    public function setMerchantFields($value)
    {
        return $this->setParameter('merchant_fields', $value);
    }

    /**
     * @return ?array
     */
    public function getMerchantFields()
    {
        return $this->getParameter('merchant_fields');
    }

    /**
     * End of the time when the customer can use the hosted page, in Unix time.
     * If page_expiration is not set, the hosted page expires 14 days after creation.
     * Range: 1 minute to 30 days.
     *
     * @param  int  $value
     */
    public function setPageExpiration($value)
    {
        return $this->setParameter('page_expiration', $value);
    }

    /**
     * @return ?int
     */
    public function getPageExpiration()
    {
        return $this->getParameter('page_expiration');
    }

    /**
     * Length of time for the payment to be completed after it is created, measured in seconds.
     * When both expiration and payment_expiration are set, the payment expires at the earlier time.
     *
     * @param  int  $value
     */
    public function setPaymentExpiration($value)
    {
        return $this->setParameter('payment_expiration', $value);
    }

    /**
     * @return ?int
     */
    public function getPaymentExpiration()
    {
        return $this->getParameter('payment_expiration');
    }

    /**
     * Object that defines transaction fees and foreign exchange fees.
     * These are fees that the Rapyd merchant can define for its consumers in addition to the payment amount.
     * They are not related to the fees Rapyd charges to its clients.
     *
     * @param  PaymentFees  $value
     */
    public function setPaymentFees($value)
    {
        return $this->setParameter('payment_fees', $value);
    }

    /**
     * @return ?PaymentFees $value
     */
    public function getPaymentFees()
    {
        return $this->getParameter('payment_fees');
    }

    /**
     * The type of the payment method. For example, it_visa_card.
     * To get a list of payment methods for a country, use [List Payment Methods by Country](https://docs.rapyd.net/en/list-payment-methods-by-country.html).
     * See [Configuring List of Payment Methods](https://docs.rapyd.net/en/configuring-list-of-payment-methods.html).
     *
     * @param  string  $value
     */
    public function setPaymentMethodType($value)
    {
        return $this->setParameter('payment_method_type', $value);
    }

    /**
     * @return ?string
     */
    public function getPaymentMethodType()
    {
        return $this->getParameter('payment_method_type');
    }

    /**
     * A list of the categories of payment method that are supported on the checkout page.
     * The categories appear on the page in the order provided.
     * One or more of the following:
     * - bank_redirect
     * - bank_transfer
     * - card
     * - cash
     * - ewallet
     * See [Configuring List of Payment Methods](https://docs.rapyd.net/en/configuring-list-of-payment-methods.html).
     *
     * @param  array  $value
     */
    public function setPaymentMethodTypeCategories($value)
    {
        return $this->setParameter('payment_method_type_categories', $value);
    }

    /**
     * @return ?array
     */
    public function getPaymentMethodTypeCategories()
    {
        return $this->getParameter('payment_method_type_categories');
    }

    /**
     * List of payment methods that are excluded from display on the checkout page.
     * See [Configuring List of Payment Methods](https://docs.rapyd.net/en/configuring-list-of-payment-methods.html).
     *
     * @param  array  $value
     */
    public function setPaymentMethodTypesExclude($value)
    {
        return $this->setParameter('payment_method_types_exclude', $value);
    }

    /**
     * @return ?array
     */
    public function getPaymentMethodTypesExclude()
    {
        return $this->getParameter('payment_method_types_exclude');
    }

    /**
     * List of payment methods that are displayed on the checkout page.
     * The payment methods appear on the page in the order provided.
     * See [Configuring List of Payment Methods](https://docs.rapyd.net/en/configuring-list-of-payment-methods.html).
     *
     * @param  array  $value
     */
    public function setPaymentMethodTypesInclude($value)
    {
        return $this->setParameter('payment_method_types_include', $value);
    }

    /**
     * @return ?array
     */
    public function getPaymentMethodTypesInclude()
    {
        return $this->getParameter('payment_method_types_include');
    }

    /**
     * When fixed_side is sell, it is the currency received by the merchant.
     * When fixed_side is buy, it is the currency charged to the buyer (customer). Three-letter ISO 4217 code.
     * The checkout page displays the following information:
     * The original amount and currency.
     * The converted amount in the requested currency.
     * The exchange rate.
     * Relevant to payments with FX.
     *
     * @param  string  $value
     */
    public function setRequestedCurrency($value)
    {
        return $this->setParameter('requested_currency', $value);
    }

    /**
     * @return ?string
     */
    public function getRequestedCurrency()
    {
        return $this->getParameter('requested_currency');
    }

    /**
     * A text description suitable for a customer's payment statement. 5-22 characters.
     *
     * @param  string  $value
     */
    public function setStatementDescriptor($value)
    {
        return $this->setParameter('statement_descriptor', $value);
    }

    /**
     * @return ?string
     */
    public function getStatementDescriptor()
    {
        return $this->getParameter('statement_descriptor');
    }

    public function getData()
    {
        $this->validate('amount', 'country', 'currency');

        return array_filter([
            'account_funding_transaction' => $this->getAccountFundingTransaction(),
            'amount' => $this->getAmount(),
            'cancel_checkout_url' => $this->getCancelUrl(),
            'capture' => $this->getCapture(),
            'cart_items' => $this->getItems(),
            'complete_checkout_url' => $this->getReturnUrl(),
            'complete_payment_url' => $this->getCompletePaymentUrl(),
            'country' => $this->getCountry(),
            'currency' => $this->getCurrency(),
            'custom_elements' => $this->getCustomElements(),
            'customer' => $this->getCustomer(),
            'description' => $this->getDescription(),
            'error_payment_url' => $this->getErrorPaymentUrl(),
            'escrow' => $this->getEscrow(),
            'escrow_release_days' => $this->getEscrowReleaseDays(),
            'ewallet' => $this->getEwallet(),
            'ewallets' => $this->getEwallets(),
            'expiration' => $this->getExpiration(),
            'fixed_side' => $this->getFixedSide(),
            'language' => $this->getLanguage(),
            'merchant_fields' => $this->getMerchantFields(),
            'merchant_reference_id' => $this->getMerchantReferenceId(),
            'metadata' => $this->getMetadata(),
            'page_expiration' => $this->getPageExpiration(),
            'payment_expiration' => $this->getPaymentExpiration(),
            'payment_method_type' => $this->getPaymentMethodType(),
            'payment_method_type_categories' => $this->getPaymentMethodTypeCategories(),
            'payment_method_types_exclude' => $this->getPaymentMethodTypesExclude(),
            'payment_method_types_include' => $this->getPaymentMethodTypesInclude(),
            'requested_currency' => $this->getRequestedCurrency(),
            'statement_descriptor' => $this->getStatementDescriptor(),
        ], static function ($value) {
            return $value !== null && $value !== '';
        });
    }

    /**
     * @throws InvalidResponseException
     */
    public function sendData($data)
    {
        $uri = $this->getEndpoint().'/v1/checkout';
        $clientHelper = new ClientHelper($this->httpClient, Signature::create($this));
        $result = $clientHelper->request('POST', $uri, [], $data);

        return $this->response = new CheckoutPurchaseResponse($this, $result);
    }

    /**
     * @return array
     */
    public function getItems()
    {
        $itemBag = parent::getItems();
        if ($itemBag === null) {
            return null;
        }

        $cartItems = [];
        /** @var Item $item */
        foreach ($itemBag as $item) {
            $cartItems[] = array_filter([
                'amount' => $item->getAmount(),
                'image' => $item->getImage(),
                'name' => $item->getName(),
                'quantity' => $item->getQuantity(),
            ], static function ($value) {
                return $value !== null;
            });
        }

        return $cartItems;
    }
}
