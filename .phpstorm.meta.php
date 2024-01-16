<?php

namespace PHPSTORM_META {

    /** @noinspection PhpIllegalArrayKeyTypeInspection */
    /** @noinspection PhpUnusedLocalVariableInspection */
    $STATIC_METHOD_TYPES = [
      \Omnipay\Omnipay::create('') => [
        'Rapyd' instanceof \Omnipay\Rapyd\CheckoutGateway,
      ],
      \Omnipay\Common\GatewayFactory::create('') => [
        'Rapyd' instanceof \Omnipay\Rapyd\CheckoutGateway,
      ],
    ];
}
