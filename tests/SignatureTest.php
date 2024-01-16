<?php

namespace Omnipay\Rapyd\Tests;

use DateTime;
use Omnipay\Rapyd\Tests\Fixtures\StubSignature;
use PHPUnit\Framework\TestCase;

class SignatureTest extends TestCase
{
    private $accessKey = '41473424D6BDB8C19778';
    private $secretKey = 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8';

    public function testGetHeaders(): void
    {
        $signature = new StubSignature($this->accessKey, $this->secretKey);
        $body = [
            "amount" => 100,
            "complete_checkout_url" => "https://example.com/complete",
            "country" => "US",
            "currency" => "USD",
            "cancel_checkout_url" => "https://example.com/cancel",
            "language" => "en",
        ];

        self::assertEquals(
            $this->makeRequest('post', '', $body),
            $signature->getHeaders('POST', '', $body)
        );
    }

    private function makeRequest($method, $path, $body = null)
    {
        $access_key = '41473424D6BDB8C19778';
        $secret_key = 'a699faeb232ecf91666c7db11e2ec615a90ef3139d059273f963cbb28acd7ff582d8f08fd34419e8';

        $idempotency = '123456789012';
        $http_method = $method;
        $salt = '123456789012';
        $date = new DateTime();
        $timestamp = $date->getTimestamp();

        $body_string = ! is_null($body) ? json_encode($body, JSON_UNESCAPED_SLASHES) : '';
        $sig_string = "$http_method$path$salt$timestamp$access_key$secret_key$body_string";

        $hash_sig_string = hash_hmac("sha256", $sig_string, $secret_key);
        $signature = base64_encode($hash_sig_string);

        return [
            "Content-Type" => 'application/json',
            "access_key" => $access_key,
            "salt" => $salt,
            "timestamp" => $timestamp,
            "signature" => $signature,
            "idempotency" => $idempotency,
        ];
    }
}
