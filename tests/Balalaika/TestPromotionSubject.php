<?php

namespace Balalaika;

use Balalaika\Entity\PromotionSubjectInterface;

class TestPromotionSubject implements PromotionSubjectInterface
{
    public function getTotal()
    {
        return 100;
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
