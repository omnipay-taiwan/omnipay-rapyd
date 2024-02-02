<?php

namespace Omnipay\Rapyd;

use Omnipay\Common\Helper;
use Omnipay\Common\ParametersTrait;
use Symfony\Component\HttpFoundation\ParameterBag;

class Address
{
    use ParametersTrait;

    public function __construct(?array $parameters = null)
    {
        $this->initialize($parameters);
    }

    public function initialize(?array $parameters = null)
    {
        $this->parameters = new ParameterBag;

        Helper::initialize($this, $parameters);

        return $this;
    }

    /**
     * Name of the canton administrative subdivision, as used in banking.
     *
     * @param  string  $value
     */
    public function setCanton($value)
    {
        $this->setParameter('canton', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getCanton()
    {
        return $this->getParameter('canton');
    }

    /**
     * City portion of the address. Required for issuance of a card to the wallet contact.
     *
     * @param  string  $value
     */
    public function setCity($value)
    {
        $this->setParameter('city', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getCity()
    {
        return $this->getParameter('city');
    }

    /**
     * The two-letter ISO 3166-1 ALPHA-2 code for the country.
     *
     * @param  string  $value
     */
    public function setCountry($value)
    {
        $this->setParameter('country', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getCountry()
    {
        return $this->getParameter('country');
    }

    /**
     * Name of the district administrative subdivision, as used in banking.
     *
     * @param  string  $value
     */
    public function setDistrict($value)
    {
        $this->setParameter('district', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getDistrict()
    {
        return $this->getParameter('district');
    }

    /**
     * Line 1 of the address, such as a building number and street name.
     *
     * @param  string  $value
     */
    public function setLine1($value)
    {
        $this->setParameter('line_1', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getLine1()
    {
        return $this->getParameter('line_1');
    }

    /**
     * Line 2 of the address, such as a suite or apartment number, or the name of a named building.
     *
     * @param  string  $value
     */
    public function setLine2($value)
    {
        $this->setParameter('line_2', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getLine2()
    {
        return $this->getParameter('line_2');
    }

    /**
     * Line 3 of the address.
     *
     * @param  string  $value
     */
    public function setLine3($value)
    {
        $this->setParameter('line_3', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getLine3()
    {
        return $this->getParameter('line_3');
    }

    /**
     * A JSON object defined by the client. See Metadata.
     *
     * @param  array  $value
     */
    public function setMetadata($value)
    {
        $this->setParameter('metadata', $value);

        return $this;
    }

    /**
     * @return ?array
     */
    public function getMetadata()
    {
        return $this->getParameter('metadata');
    }

    /**
     * The name of a contact person or an "in care of" person at this address.
     * For a personal wallet contact type, alphabetic characters and spaces.
     *
     * @param  string  $value
     */
    public function setName($value)
    {
        $this->setParameter('name', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getName()
    {
        return $this->getParameter('name');
    }

    /**
     * Phone number associated with this specific address in E.164 format. Must be unique.
     *
     * @param  string  $value
     */
    public function setPhoneNumber($value)
    {
        $this->setParameter('phone_number', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getPhoneNumber()
    {
        return $this->getParameter('phone_number');
    }

    /**
     * State or province portion of the address.
     *
     * @param  string  $value
     */
    public function setState($value)
    {

        $this->setParameter('state', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getState()
    {
        return $this->getParameter('state');
    }

    /**
     * Postal code portion of the address.
     *
     * @param  string  $value
     */
    public function setZip($value)
    {
        $this->setParameter('zip', $value);

        return $this;
    }

    /**
     * @return ?string
     */
    public function getZip()
    {
        return $this->getParameter('zip');
    }
}
