<?php

namespace Omnipay\Rapyd;

use Omnipay\Common\Item as BaseItem;

class Item extends BaseItem
{
    /**
     * @param  string  $value
     */
    public function setImage($value)
    {
        return $this->setParameter('image', $value);
    }

    public function getImage()
    {
        return $this->getParameter('image');
    }

    /**
     * Set the item amount
     */
    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    /**
     * Set the item price
     */
    public function setPrice($value)
    {
        return $this->setAmount($value);
    }

    public function getPrice()
    {
        return $this->getAmount();
    }
}
