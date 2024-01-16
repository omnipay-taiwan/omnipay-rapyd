<?php

namespace Omnipay\Rapyd;

use DateTime;

class Signature
{
    /**
     * @var string
     */
    private $accessKey;
    /**
     * @var string
     */
    private $secretKey;

    /**
     * @param  string  $accessKey
     * @param  string  $secretKey
     */
    public function __construct(string $accessKey, string $secretKey)
    {
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
    }

    /**
     * @param  string  $method
     * @param  string  $path
     * @param ?array  $body
     * @return array
     */
    public function getHeaders($method, $path, $body = null)
    {
        $idempotency = $this->generateString();
        $httpMethod = $method;
        $salt = $this->generateString();
        $date = new DateTime();
        $timestamp = $date->getTimestamp();

        $bodyString = ! is_null($body) ? json_encode($body, JSON_UNESCAPED_SLASHES) : '';
        $sigString = implode('', [
            $httpMethod, $path, $salt, $timestamp, $this->accessKey, $this->secretKey, $bodyString,
        ]);

        return [
            "Content-Type" => 'application/json',
            'access_key' => $this->accessKey,
            'salt' => $salt,
            'timestamp' => $timestamp,
            'signature' => base64_encode(hash_hmac("sha256", $sigString, $this->secretKey)),
            'idempotency' => $idempotency,
        ];
    }

    protected function generateString()
    {
        return Helper::generateString();
    }
}
