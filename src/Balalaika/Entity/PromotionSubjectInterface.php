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

    /**
     * Get product line item total.
     *
     * @return int
     */
    public function getProductTotal();

    /**
     * Add a discount to the order total.
     *
     * @param int $discount
     */
    public function addOrderDiscount($discount);

    /**
     * Sets the order shipping to 0 added as a discount.  TODO: this could be more abstract
     * and only use one method: "AddPromotion()"
     */
    public function setFreeShipping();

    /**
     * @return boolean
     */
    public function isFirstTimeCustomer();

    /**
     * Get the shipping address zipcode.
     *
     * @return int
     */
    public function getShippingZipcode();

    /**
     * Get the user entity identifier.
     *
     * @return int
     */
    public function getUserId();

    /**
     * Get a DateTime value according to the system settings.
     *
     * @param mixed $dateTime - Commonly a string (2014-04-16 06:00) or an int for timestamps.
     */
    public function getDateTime($dateTime = null);

    /**
     * Get a comparable DateTime value using the system settings.
     *
     * @return mixed
     */
    public function getCurrentDateTime();

    /**
     * Get the customer submitted promotion code. 
     *
     * @return string
     */
    public function getPromotionCode();

    /**
     * Get how many times this promotion has been used by the system.
     *
     * @return int
     */
    public function getPromotionUsageCount();

    /**
     * Get how many times this promotion has been used by the order owner.
     *
     * @return int
     */
    public function getPromotionUserCount();
}