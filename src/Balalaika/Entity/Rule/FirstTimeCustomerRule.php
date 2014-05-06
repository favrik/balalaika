<?php

namespace Balalaika\Entity\Rule;

use Balalaika\Entity\PromotionSubjectInterface;

class FirstTimeCustomerRule extends BaseRule
{
    protected $operators = array(
        1 => 'true',
        0 => 'false',
    );

    public function isValid(PromotionSubjectInterface $subject)
    {
        return $this->operator && $subject->isFirstTimeCustomer();
    }
}
