<?php


namespace Balalaika\Entity;

/**
 * Instead of using multiple interfaces, let's just put all that Balalaika needs
 * in here.
 */
interface PromotionSubjectInterface
{
    /**
     * Get order total.
     *
     * @return int
     */
    public function getOrderTotal();

    public function getProductTotal();

    public function addOrderDiscount($discount);

    public function setFreeShipping();

    /**
     * @return boolean
     */
    public function isFirstTimeCustomer();

    /**
     * Get the shipping address zipcode.
     *
     * @return mixed
     */
    public function getShippingZipcode();

    /**
     * Get the user entity identifier.
     *
     * @return mixed
     */
    public function getUserId();

    public function getDateTime($dateTime = null);

    public function getCurrentDateTime();

    public function getPromotionCode();

    public function getPromotionUsageCount();

    public function getPromotionUserCount();
}
