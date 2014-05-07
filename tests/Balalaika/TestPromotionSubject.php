<?php

namespace Balalaika;

use Balalaika\Entity\PromotionSubjectInterface;

class TestPromotionSubject implements PromotionSubjectInterface
{
    protected $total = 100;

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getOrderTotal()
    {
        return $this->total;
    }

    public function getProductTotal()
    {
        return 80;
    }

    public function setFreeShipping()
    {
    }

    public function addOrderDiscount($discount)
    {
        $this->total -= $discount;
    }

    public function isFirstTimeCustomer()
    {
        return true;
    }

    public function getShippingZipcode()
    {
        return 92231;
    }

    public function getUserId()
    {
        return 1;
    }

    public function getDateTime($dateTime = null)
    {
        if ($dateTime) {
            return new \DateTime($dateTime);
        }

        return new \DateTime();
    }

    public function getCurrentDateTime()
    {
        return $this->getDateTime('2014-05-06');
    }

    public function getPromotionCode()
    {
        return 'ABC';
    }

    public function getPromotionUsageCount()
    {
        return 10;
    }

    public function getPromotionUserCount()
    {
        return 1;
    }
}
