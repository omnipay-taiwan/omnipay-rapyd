<?php

namespace Omnipay\Rapyd;

use Omnipay\Common\Helper;
use Omnipay\Common\ParametersTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

class ClientDetails
{
    use ParametersTrait;

    public function __construct(array $parameters = null)
    {
        $this->initialize($parameters);
    }

    public function initialize(array $parameters = null)
    {
        $this->parameters = new ParameterBag;

        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * IP address of the customer.
     * @param  string  $value
     */
    public function setIpAddress($value)
    {
        $this->setParameter('ip_address', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getIpAddress()
    {
        return $this->getParameter('ip_address');
    }

    /**
     * Indicates whether the browser is enabled for Java.
     * @param  bool  $value
     */
    public function setJavaEnabled($value)
    {
        $this->setParameter('java_enabled', $value);

        return $this;
    }

    /**
     * @return ?bool
     */
    public function getJavaEnabled()
    {
        return $this->getParameter('java_enabled');
    }

    /**
     * Indicates whether the browser is enabled for JavaScript.
     * @param  bool  $value
     */
    public function setJavaScriptEnabled($value)
    {
        $this->setParameter('java_script_enabled', $value);

        return $this;
    }

    /**
     * @return ?bool
     */
    public function getJavaScriptEnabled()
    {
        return $this->getParameter('java_script_enabled');
    }

    /**
     * The language the browser is configured for, as defined in IETF BCP 47.
     * @param  string  $value
     */
    public function setLanguage($value)
    {
        $this->setParameter('language', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * Indicates the screen color depth of the customer's browser, in bits.
     * Valid values: 1, 4, 8, 15, 16, 24, 32, 48.
     *
     * @param  int  $value
     */
    public function setScreenColorDepth($value)
    {
        $this->setParameter('screen_color_depth', $value);

        return $this;
    }

    /**
     * @return ?int
     */
    public function getScreenColorDepth()
    {
        return $this->getParameter('screen_color_depth');
    }

    /**
     * Height of the customer's screen, in pixels. 1-6 digits.
     * @param  int  $value
     */
    public function setScreenHeight($value)
    {
        $this->setParameter('screen_height', $value);

        return $this;
    }

    /**
     * @return ?int
     */
    public function getScreenHeight()
    {
        return $this->getParameter('screen_height');
    }

    /**
     * Width of the customer's screen, in pixels. 1-6 digits.
     * @param  int  $value
     */
    public function setScreenWidth($value)
    {
        $this->setParameter('screen_width', $value);

        return $this;
    }

    /**
     * @return ?int
     */
    public function getScreenWidth()
    {
        return $this->getParameter('screen_width');
    }

    /**
     * Difference in minutes between UTC and the customer's time zone. Positive or negative integer.
     * @param  int  $value
     */
    public function setTimeZoneOffset($value)
    {
        $this->setParameter('time_zone_offset', $value);

        return $this;
    }

    /**
     * @return ?int
     */
    public function getTimeZoneOffset()
    {
        return $this->getParameter('time_zone_offset');
    }
}
