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
}
