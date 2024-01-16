<?php

namespace Omnipay\Rapyd\Message;

use Omnipay\Rapyd\Traits\HasRapyd;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class AuthorizeRequest extends AbstractRequest
{
    use HasRapyd;

    public function getData()
    {
        $this->validate('amount', 'card');
        $this->getCard()->validate();

        return $this->getBaseData();
    }

    public function sendData($data)
    {
        $url = $this->getEndpoint().'?'.http_build_query($data, '', '&');
        $response = $this->httpClient->request('GET', $url);

        $data = json_decode($response->getBody(), true);

        return $this->createResponse($data);
    }

    protected function getBaseData()
    {
        return [
            'transaction_id' => $this->getTransactionId(),
            'expire_date' => $this->getCard()->getExpiryDate('mY'),
            'start_date' => $this->getCard()->getStartDate('mY'),
        ];
    }
}
