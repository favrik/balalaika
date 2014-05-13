<?php

namespace Balalaika\Action;

use Balalaika\Entity\PromotionSubjectInterface;

class DiscountPercentageAction implements ActionInterface
{
    protected $percentage;

    public function initialize($percentage)
    {
        $this->percentage = $percentage;
    }

    /**
     * Always applied to the product total.
     */
    public function perform(PromotionSubjectInterface $subject)
    {
        if ($this->isValid()) {
            $rate = $this->percentage / 100;
            $subject->addOrderDiscount($subject->getProductTotal() * $rate);
        }
    }

    public function isValid()
    {
        return
            is_int($this->percentage)
            &&
            filter_var(
                $this->percentage,
                FILTER_VALIDATE_INT,
                array('options' => array('min_range' => 1, 'max_range' => 100))
            )
            ;
    }
}
