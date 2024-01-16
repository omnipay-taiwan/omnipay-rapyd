<?php

namespace Omnipay\Rapyd\Tests;

use Omnipay\Rapyd\TransactionFee;
use PHPUnit\Framework\TestCase;

class TransactionFeeTest extends TestCase
{
    public function testTransactionFee()
    {
        $transactionFee = new TransactionFee();
        $transactionFee->setCalcType('net');
        $transactionFee->setFeeType('percentage');
        $transactionFee->setValue(5);

        self::assertEquals([
            'calc_type' => 'net',
            'fee_type' => 'percentage',
            'value' => 5,
        ], $transactionFee->getParameters());
    }
}
