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
        $timestamp = (new DateTime())->getTimestamp();
        $salt = $this->generateString();
        $idempotency = $this->generateString();

        $data = [
            strtolower($method),
            $path,
            $salt,
            $timestamp,
            $this->accessKey,
            $this->secretKey,
            ! is_null($body) ? json_encode($body, JSON_UNESCAPED_SLASHES) : '',
        ];

        return [
            'Content-Type' => 'application/json',
            'access_key' => $this->accessKey,
            'salt' => $salt,
            'timestamp' => $timestamp,
            'signature' => $this->makeHash($data),
            'idempotency' => $idempotency,
        ];
    }

    public function check($knownString, $url, $salt, $timestamp, $content)
    {
        return hash_equals($knownString, $this->makeHash([
            $url,
            $salt,
            $timestamp,
            $this->accessKey,
            $this->secretKey,
            $content,
        ]));
    }


    public function checkRequest(Request $request)
    {
        return $this->check(
            $request->headers->get('signature') ?: '',
            $request->getUri(),
            $request->headers->get('salt'),
            $request->headers->get('timestamp'),
            trim($request->getContent())
        );
    }

    /**
     * @param  array  $data
     * @return string
     */
    public function makeHash($data): string
    {
        return base64_encode(
            hash_hmac('sha256', implode('', $data), $this->secretKey)
        );
    }

    protected function generateString()
    {
        return Helper::generateString();
    }
}
