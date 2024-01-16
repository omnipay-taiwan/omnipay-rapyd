<?php

namespace Omnipay\Rapyd;

class Helper
{
    public static function generateString()
    {
        $permittedChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle($permittedChars), 0, 12);
    }
}
