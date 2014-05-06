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

    public function isValid(PromotionSubjectInterface $subject)
    {
        return version_compare($subject->getTotal(), $this->value, $this->operator);
    }
}
