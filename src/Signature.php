<?php

namespace Omnipay\Rapyd;

use DateTime;
use Omnipay\Rapyd\Traits\HasRapyd;
use Symfony\Component\HttpFoundation\Request;

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

    public function __construct(string $accessKey, string $secretKey)
    {
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
    }

    /**
     * @param  HasRapyd  $request
     * @return self
     */
    public static function create($request)
    {
        return new self($request->getAccessKey(), $request->getSecretKey());
    }

    /**
     * @param  string  $method
     * @param  string  $path
     * @param  ?array  $body
     * @return array
     */
    public function getHeaders($method, $path, $body = null)
    {
        $idempotency = $this->generateString();
        $httpMethod = strtolower($method);
        $salt = $this->generateString();
        $date = new DateTime();
        $timestamp = $date->getTimestamp();

        $bodyString = ! is_null($body) ? json_encode($body, JSON_UNESCAPED_SLASHES) : '';
        $sigString = implode('', [
            $httpMethod, $path, $salt, $timestamp, $this->accessKey, $this->secretKey, $bodyString,
        ]);

        return [
            'Content-Type' => 'application/json',
            'access_key' => $this->accessKey,
            'salt' => $salt,
            'timestamp' => $timestamp,
            'signature' => base64_encode(hash_hmac('sha256', $sigString, $this->secretKey)),
            'idempotency' => $idempotency,
        ];
    }

    public function checkRequest(Request $request)
    {
        return $this->check(
            $request->headers->get('signature'),
            $request->getUri(),
            $request->headers->get('salt'),
            $request->headers->get('timestamp'),
            trim($request->getContent())
        );
    }

    public function check($plainText, $urlPath, $salt, $timestamp, $content)
    {
        $signature = base64_encode(
            hash_hmac('sha256', implode('', [
                $urlPath,
                $salt,
                $timestamp,
                $this->accessKey,
                $this->secretKey,
                $content,
            ]), $this->secretKey)
        );

        return hash_equals($plainText ?: '', $signature);
    }

    protected function generateString()
    {
        return Helper::generateString();
    }
}
