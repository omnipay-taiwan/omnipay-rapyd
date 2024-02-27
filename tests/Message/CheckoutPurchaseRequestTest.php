<?php

namespace Omnipay\Rapyd\Tests\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Rapyd\Message\CheckoutPurchaseRequest;
use Omnipay\Tests\TestCase;

class CheckoutPurchaseRequestTest extends TestCase
{
    public function testPurchaseParameters()
    {
        $request = new CheckoutPurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize(array_merge([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
        ], [
            'amount' => 100,
            'cancel_checkout_url' => 'https://foo.bar/cancel_checkout_url',
            'capture' => false,
            'complete_checkout_url' => 'https://foo.bar/complete_checkout_url',
            'complete_payment_url' => 'https://foo.bar/complete_payment_url',
            'country' => 'US',
            'currency' => 'USD',
            'customer' => 'cus_12345',
            'description' => 'description',
            'error_payment_url' => 'https://foo.bar/error_payment_url',
            'escrow' => true,
            'escrow_release_days' => 50,
            'ewallet' => 'aabbccddee',
            'fixed_side' => 'sell',
            'language' => 'en',
            'merchant_reference_id' => 'merchant reference id',
            'metadata' => ['merchant_defined' => true],
            'page_expiration' => 1705474787,
            'payment_expiration' => 60,
            'payment_method_type' => 'card',
            'payment_method_type_categories' => ['card', 'cash'],
            'payment_method_types_exclude' => ['bank_redirect'],
            'payment_method_types_include' => ['card'],
            'requested_currency' => 'USD',
            'statement_descriptor' => 'customer\'s payment statement',
        ]));

        self::assertEquals([
            'amount' => '100.00',
            'cancel_checkout_url' => 'https://foo.bar/cancel_checkout_url',
            'capture' => false,
            'complete_checkout_url' => 'https://foo.bar/complete_checkout_url',
            'complete_payment_url' => 'https://foo.bar/complete_payment_url',
            'country' => 'US',
            'currency' => 'USD',
            'customer' => 'cus_12345',
            'description' => 'description',
            'error_payment_url' => 'https://foo.bar/error_payment_url',
            'escrow' => true,
            'escrow_release_days' => 50,
            'ewallet' => 'aabbccddee',
            'fixed_side' => 'sell',
            'language' => 'en',
            'merchant_reference_id' => 'merchant reference id',
            'metadata' => ['merchant_defined' => true],
            'page_expiration' => 1705474787,
            'payment_expiration' => 60,
            'payment_method_type' => 'card',
            'payment_method_type_categories' => ['card', 'cash'],
            'payment_method_types_exclude' => ['bank_redirect'],
            'payment_method_types_include' => ['card'],
            'requested_currency' => 'USD',
            'statement_descriptor' => 'customer\'s payment statement',
        ], $request->getData());
    }

    public function testSendSuccess()
    {
        // $request = new CheckoutPurchaseRequest(
        //     new \Omnipay\Common\Http\Client(new \GuzzleHttp\Client()),
        //     $this->getHttpRequest()
        // );
        $request = new CheckoutPurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->setMockHttpResponse('CheckoutPurchaseSuccess.txt');

        $request->initialize(array_merge([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
            'testMode' => 1,
        ], [
            'amount' => 100,
            'country' => 'US',
            'currency' => 'USD',
            'language' => 'en',
            'return_url' => 'https://example.com/complete',
            'cancel_url' => 'https://example.com/cancel',
            'transactionId' => '0912-2021',
        ]));

        $response = $request->send();

        self::assertFalse($response->isSuccessful());
        self::assertTrue($response->isRedirect());
        self::assertEquals('GET', $response->getRedirectMethod());
        self::assertEquals(
            'https://sandboxcheckout.rapyd.net?token=checkout_b1284339d1dd677c8163bcea1c9cfcf2',
            $response->getRedirectUrl()
        );
        self::assertEquals('0912-2021', $response->getTransactionId());
        self::assertEquals('checkout_b1284339d1dd677c8163bcea1c9cfcf2', $response->getTransactionReference());
    }

    public function testSendFailed()
    {
        $this->expectException(InvalidResponseException::class);
        $this->expectExceptionMessage('The request tried to create a checkout page, but one or more of the payment method type categories was not enabled. The request was rejected. Corrective action: Use the Client Portal to enable the payment method type categories you want to appear in the checkout page.');

        $request = new CheckoutPurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->setMockHttpResponse('CheckoutPurchaseFailed.txt');

        $request->initialize(array_merge([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
            'testMode' => 1,
        ], [
            'amount' => 100,
            'country' => 'US',
            'currency' => 'USD',
            'language' => 'en',
            'return_url' => 'https://example.com/complete',
            'cancel_url' => 'https://example.com/cancel',
            'payment_method_type_categories' => ['ewallet'],
        ]));

        $request->send();
    }
}
