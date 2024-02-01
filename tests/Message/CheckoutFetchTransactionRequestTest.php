<?php

namespace Omnipay\Rapyd\Tests\Message;

use Omnipay\Rapyd\Message\CheckoutFetchTransactionRequest;
use Omnipay\Tests\TestCase;

class CheckoutFetchTransactionRequestTest extends TestCase
{
    public function testTransactionNew()
    {
        // $fetchTransactionRequest = new CheckoutFetchTransactionRequest(
        //     new \Omnipay\Common\Http\Client(new \GuzzleHttp\Client()),
        //     $this->getHttpRequest()
        // );

        $fetchTransactionRequest = new CheckoutFetchTransactionRequest(
            $this->getHttpClient(),
            $this->getHttpRequest()
        );
        $this->setMockHttpResponse('CheckoutFetchTransactionNew.txt');

        $fetchTransactionRequest->initialize(array_merge([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
            'testMode' => 1,
        ], [
            'checkout' => 'checkout_ac18419fb53bceca963a43560ab3f591',
        ]));

        $response = $fetchTransactionRequest->send();

        self::assertEquals(null, $response->getCode());
        self::assertFalse($response->isSuccessful());
        self::assertEquals('checkout_ac18419fb53bceca963a43560ab3f591', $response->getTransactionReference());

        $lastRequest = $this->getMockClient()->getLastRequest();
        $path = $lastRequest->getUri()->getPath();
        $transactionReference = substr($path, strrpos($path, '/') + 1);
        self::assertEquals(
            'checkout_ac18419fb53bceca963a43560ab3f591',
            $transactionReference
        );
    }

    public function testTransactionDon()
    {
        // $fetchTransactionRequest = new CheckoutFetchTransactionRequest(
        //     new \Omnipay\Common\Http\Client(new \GuzzleHttp\Client()),
        //     $this->getHttpRequest()
        // );

        $fetchTransactionRequest = new CheckoutFetchTransactionRequest(
            $this->getHttpClient(),
            $this->getHttpRequest()
        );
        $this->setMockHttpResponse('CheckoutFetchTransactionDon.txt');

        $fetchTransactionRequest->initialize(array_merge([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
            'testMode' => 1,
        ], [
            'checkout' => 'checkout_ac18419fb53bceca963a43560ab3f591',
        ]));

        $response = $fetchTransactionRequest->send();

        self::assertEquals('CLO', $response->getCode());
        self::assertTrue($response->isSuccessful());
        self::assertEquals('checkout_ac18419fb53bceca963a43560ab3f591', $response->getTransactionReference());
    }

    public function testTransactionRefund()
    {
        // $fetchTransactionRequest = new CheckoutFetchTransactionRequest(
        //     new \Omnipay\Common\Http\Client(new \GuzzleHttp\Client()),
        //     $this->getHttpRequest()
        // );

        $fetchTransactionRequest = new CheckoutFetchTransactionRequest(
            $this->getHttpClient(),
            $this->getHttpRequest()
        );
        $this->setMockHttpResponse('CheckoutFetchTransactionRefund.txt');

        $fetchTransactionRequest->initialize(array_merge([
            'access_key' => '41473424D6BDB8C19778',
            'secret_key' => 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8',
            'testMode' => 1,
        ], [
            'checkout' => 'checkout_ac18419fb53bceca963a43560ab3f591',
        ]));

        $response = $fetchTransactionRequest->send();

        self::assertEquals('CLO', $response->getCode());
        self::assertFalse($response->isSuccessful());
        self::assertEquals('checkout_ac18419fb53bceca963a43560ab3f591', $response->getTransactionReference());
    }
}
