<?php

namespace Balalaika\Action;

use Balalaika\Entity\PromotionSubjectInterface;

class DiscountFixedAmountAction implements ActionInterface
{
    protected $amount;

    public function initialize($amount)
    {
        $this->amount = $amount;
    }

    public function perform(PromotionSubjectInterface $subject)
    {
        if ($this->isValid()) {
            $discountedTotal = $subject->getOrderTotal() - $this->amount;
            if ($discountedTotal < 0) {
                // Modify amount to make the order total non-negative and stop at 0.
                $this->amount -= $discountedTotal;
            }

            $subject->addOrderDiscount($this->amount);
        }
    }

    protected function isValid()
    {
        return is_int($this->amount);
    }
}
