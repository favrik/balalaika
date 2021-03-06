<?php

namespace Balalaika\Entity\Rule;

use Balalaika\Entity\PromotionSubjectInterface;
use Balalaika\Builder\BuilderUtil;

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
    protected $initialized = false;

    /**
     * Pseudo constructor to be able to access methods before initialization.
     */
    public function initialize($operator, $value = null)
    {
        if (!isset($this->operators[$operator])) {
            throw new \Exception('Invalid operator passed: ' . $operator);
        }

        $this->operator = $operator;
        $this->value = $value;
        $this->initialized = true;
    }

    /**
     * Returns the valid operators for this rule.
     *
     * @return array
     */
    public function getOperators()
    {
        return $this->operators;
    }

    /**
     * Returns a human readable name for this rule. Replacements order matters.
     *
     * @return string
     */
    public function getName()
    {
        return BuilderUtil::getMetaName(__NAMESPACE__, 'Rule', $this);
    }

    /**
     * Helper method to set the value.
     */
    public function val($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Helper method to set the operator.
     */
    public function op($operator)
    {
        $this->operator = $operator;
        return $this;
    }

    /**
     * Return the rule validation result.
     *
     * @return boolean
     */
    public function isValid(PromotionSubjectInterface $subject)
    {
        $this->ensureRuleIsInitialized();
        return $this->getValidationResult($subject);
    }

    protected function ensureRuleIsInitialized()
    {
        if (!$this->initialized) {
            throw new \Exception($this->getName() . ' was not initialized');
        }
    }

    public function getValidationResult(PromotionSubjectInterface $subject)
    {
        return false;
    }
}
