<?php

namespace Omnipay\Rapyd;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Http\ClientInterface;

class ClientHelper
{
    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var Signature
     */
    private $signature;

    public function __construct(ClientInterface $httpClient, Signature $signature)
    {
        $this->httpClient = $httpClient;
        $this->signature = $signature;
    }

    /**
     * @throws InvalidResponseException
     */
    public function request($method, $url, $headers = [], $body = null)
    {
        $path = parse_url($url, PHP_URL_PATH);
        $response = $this->httpClient->request(
            $method,
            $url,
            array_merge($headers, $this->signature->getHeaders($method, $path, $body)),
            ! is_null($body) ? json_encode($body, JSON_UNESCAPED_SLASHES) : ''
        );

        $result = json_decode((string) $response->getBody(), true);
        if ($result['status']['status'] !== 'SUCCESS') {
            throw new InvalidResponseException($result['status']['message']);
        }

        return $result;
    }
}
