<?php

namespace Omnipay\Rapyd\Tests;

use Omnipay\Rapyd\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testItem()
    {
        $item = new Item();
        $item->setAmount(100);
        $item->setImage('https://foo.bar/image.png');
        $item->setName('item name');
        $item->setQuantity(50);

        self::assertEquals([
            'amount' => 100,
            'image' => 'https://foo.bar/image.png',
            'name' => 'item name',
            'quantity' => 50,
        ], $item->getParameters());
    }
}
