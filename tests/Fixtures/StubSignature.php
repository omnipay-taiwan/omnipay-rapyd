<?php

namespace Omnipay\Rapyd\Test\Fixtures;

use Omnipay\Rapyd\Signature;

class StubSignature extends Signature
{
    protected function generateString()
    {
        return '123456789012';
    }
}
