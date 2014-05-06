<?php

namespace Balalaika\Entity\Rule;

use Balalaika\Entity\PromotionSubjectInterface;

class ListRule extends BaseRule
{
    protected $operators = array(
        'in' => 'in',
        'not in' => 'not in',
    );

    public function getSubjectValue($subject)
    {
        throw new \Exception('ListRule does not know the subject value name');
    }

    public function isValid(PromotionSubjectInterface $subject)
    {
        $in = in_array($this->getSubjectValue($subject), $this->value);
        $not_in = !$in;

        switch ($this->operator) {
            case 'in': return $in;
            case 'not in': return $not_in;
        }
    }
}
