<?php

namespace Balalaika\Entity\Rule;

use Balalaika\Entity\PromotionSubjectInterface;

class BaseRule
{
    /**
     * BaseRule is the only one that has the null operator.
     */
    protected $operators = array(
        'null' => 'null',
    );

    protected $operator = null;
    protected $value;

    public function __construct($operator, $value = null)
    {
        if (!isset($this->operators[$operator])) {
            throw new \Exception('Invalid operator passed: ' . $operator);
        }

        $this->operator = $operator;
        $this->value = $value;
    }

    /**
     * Returns the valid operators for this rule.
     *
     * @return array
     */
    public function operators()
    {
        return $this->operators;
    }

    /**
     * Returns a human readable name for this rule. Replacements order matters.
     *
     * @return string
     */
    public function name()
    {
        $base_name = str_replace(array(__NAMESPACE__, '\\', 'Rule'), '', get_class($this));
        $splitted = preg_split('/(?=[A-Z])/', $base_name, -1, PREG_SPLIT_NO_EMPTY);
        return join($splitted, ' ');
    }

    public function val($value)
    {
        $this->value = $value;
        return $this;
    }

    public function op($operator)
    {
        $this->operator = $operator;
        return $this;
    }

    /**
     * Return the rule validation result. Base rule is always invalid.
     *
     * @return boolean
     */
    public function isValid(PromotionSubjectInterface $subject)
    {
        return false;
    }
}
