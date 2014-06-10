<?php

namespace Balalaika\Entity\Rule;

use Balalaika\Entity\PromotionSubjectInterface;

class OrderTotalRule extends BaseRule
{
    protected $operators = array(
        '>=' => 'greater than or equal',
        '<=' => 'lower than or equal',
        '=' => 'equals',
    );

    public function getValidationResult(PromotionSubjectInterface $subject)
    {
        return version_compare($subject->getOrderTotal(), $this->value, $this->operator);
    }
}
