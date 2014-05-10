<?php

namespace Balalaika\Entity;

class Promotion
{
    protected $name;

    protected $activators = array();
    protected $rules = array();
    protected $actions = array();

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function apply($subject)
    {
        if ($this->isEligible($subject)) {
            foreach ($this->actions as $action) {
                $action->perform($subject);
            }

            return true;
        }

        return false;
    }

    public function isEligible(PromotionSubjectInterface $subject)
    {
        return $this->isActive($subject) && $this->isValid($subject);
    }

    protected function isActive($subject)
    {
        foreach ($this->activators as $activator) {
            if (!$activator->isActive($subject)) {
                return false;
            }
        }

        return true;
    }

    protected function isValid($subject)
    {
        foreach ($this->rules as $rule) {
            if (!$rule->isValid($subject)) {
                return false;
            }
        }

        return true;
    }

    public function setActivators(array $activators)
    {
        $this->activators = $activators;
        return $this;
    }

    public function setRules(array $rules)
    {
        $this->rules = $rules;
        return $this;
    }

    public function setActions(array $actions)
    {
        $this->actions = $actions;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
}
