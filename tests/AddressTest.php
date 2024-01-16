<?php

namespace Omnipay\Rapyd\Tests;

use Omnipay\Rapyd\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    public function testAddress()
    {
        $address = new Address();
        $address->setCanton('canton');
        $address->setCity('New York');
        $address->setCountry('USA');
        $address->setDistrict('Watson');
        $address->setLine1('Line 1');
        $address->setLine2('Line 2');
        $address->setLine3('Line 3');
        $address->setMetadata([]);
        $address->setName('Name');
        $address->setPhoneNumber('123456789');
        $address->setState('State');
        $address->setZip('12345');

        self::assertEquals([
            'canton' => 'canton',
            'city' => 'New York',
            'country' => 'USA',
            'district' => 'Watson',
            'line_1' => 'Line 1',
            'line_2' => 'Line 2',
            'line_3' => 'Line 3',
            'metadata' => [],
            'name' => 'Name',
            'phone_number' => '123456789',
            'state' => 'State',
            'zip' => '12345',
        ], $address->getParameters());
    }
}
