<?php

namespace Omnipay\Rapyd\Tests;

use Omnipay\Rapyd\FxFee;
use PHPUnit\Framework\TestCase;

class FxFeeTest extends TestCase
{
    public function testFxFee()
    {
        $fxFee = new FxFee();
        $fxFee->setCalcType('net');
        $fxFee->setValue(5);

        self::assertEquals([
            'calc_type' => 'net',
            'value' => 5,
        ], $fxFee->getParameters());
    }
}
