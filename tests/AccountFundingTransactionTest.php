<?php

namespace Omnipay\Rapyd\Tests;

use Omnipay\Rapyd\AccountFundingTransaction;
use PHPUnit\Framework\TestCase;

class AccountFundingTransactionTest extends TestCase
{
    public function testAccountFundingTransaction()
    {
        $accountFundingTransaction = new AccountFundingTransaction();
        $accountFundingTransaction->setEwallet('eWallet');
        $accountFundingTransaction->setPaymentMethodTypes([
            'credit_card',
        ]);

        self::assertEquals([
            'ewallet' => 'eWallet',
            'payment_method_types' => ['credit_card'],
        ], $accountFundingTransaction->getParameters());
    }
}
