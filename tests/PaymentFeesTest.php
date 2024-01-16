<?php

namespace Omnipay\Rapyd\Tests;

use Omnipay\Rapyd\PaymentFees;
use PHPUnit\Framework\TestCase;

class PaymentFeesTest extends TestCase
{
    public function testPaymentFees()
    {
        $paymentFees = new PaymentFees();

        self::assertEquals([], $paymentFees->getParameters());
    }
}
