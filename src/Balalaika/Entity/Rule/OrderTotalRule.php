<?php

namespace Balalaika\Entity\Rule;

use Balalaika\Entity\PromotionSubjectInterface;

class OrderTotalRule extends BaseRule
{
    protected $operators = array(
        '>' => 'greater than',
        '<' => 'lower than',
        '=' => 'equals',
    );

    public function getValidationResult(PromotionSubjectInterface $subject)
    {
        return version_compare($subject->getOrderTotal(), $this->value, $this->operator);
    }
}
