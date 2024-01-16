<?php

namespace Omnipay\Rapyd\Tests;

use Omnipay\Rapyd\ClientDetails;
use PHPUnit\Framework\TestCase;

class ClientDetailsTest extends TestCase
{
    public function testClientDetails()
    {
        $clientDetails = new ClientDetails();
        $clientDetails->setIpAddress('127.0.0.1');
        $clientDetails->setJavaEnabled(true);
        $clientDetails->setJavaScriptEnabled(false);
        $clientDetails->setLanguage('zh_TW');
        $clientDetails->setScreenColorDepth(1);
        $clientDetails->setScreenHeight(800);
        $clientDetails->setScreenWidth(600);
        $clientDetails->setTimeZoneOffset(86400);

        self::assertEquals([
            'ip_address' => '127.0.0.1',
            'java_enabled' => true,
            'java_script_enabled' => false,
            'language' => 'zh_TW',
            'screen_color_depth' => 1,
            'screen_height' => 800,
            'screen_width' => 600,
            'time_zone_offset' => 86400,
        ], $clientDetails->getParameters());
    }
}
