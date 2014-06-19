<?php

namespace Balalaika\Builder;

use Balalaika\Entity\Promotion;
use Balalaika\Entity\Activator\DateRangeActivator;
use Balalaika\Entity\Activator\CodeActivator;
use Balalaika\Entity\Rule\OrderTotalRule;
use Balalaika\Entity\Rule\FirstTimeCustomerRule;
use Balalaika\Entity\Rule\UserIsRule;
use Balalaika\Entity\Rule\ZipcodeIsRule;
use Balalaika\Action\DiscountFixedAmountAction;
use Balalaika\Action\DiscountPercentageAction;
use Balalaika\Action\FreeShippingAction;
use Balalaika\Builder\BuilderUtil;

class ArrayBuilder
{
    protected $activators;
    protected $actions;
    protected $rules;

    /**
     * Promotion array.
     */
    protected $data;

    public function __construct()
    {
        $this->registerClasses();
    }

    public function registerClasses()
    {
        $this->activators = array(
            'code' => new CodeActivator(),
            'date_range' => new DateRangeActivator(),
        );
        $this->rules = array(
            'order_total' => array('object' => new OrderTotalRule(), 'field' => 'amount'),
            'user_is' => array('object' => new UserIsRule(), 'field' => 'list'),
            'zipcode_is' => array('object' => new ZipcodeIsRule(), 'field' => 'list'),
            'first_time_customer' => array('object' => new FirstTimeCustomerRule()),
        );
        $this->actions = array(
            'discount_fixed_amount' => array('object' => new DiscountFixedAmountAction(), 'field' => 'amount'),
            'discount_percentage' => array('object' => new DiscountPercentageAction(), 'field' => 'percentage'),
            'free_shipping' => array('object' => new FreeShippingAction()),
        );
    }

    /**
     * @wishlist Auto register classes in path.
     */
    public function registerClassesInPath($loader)
    {
        $prefixes = $loader->getPrefixesPsr4();
        $prefix = array_shift($prefixes['Balalaika\\']);
    }

    public function getRules()
    {
        $options = array();
        foreach ($this->rules as $key => $config) {
            $options[$key] = array(
                'name' => $config['object']->getName(),
                'operators' => $config['object']->getOperators(),
                'field' => isset($config['field']) ? $config['field'] : null,
            );
        }

        return $options;
    }

    public function getActions()
    {
        $options = array();
        foreach ($this->actions as $key => $config) {
            $options[$key] = array(
                'name' => BuilderUtil::getMetaName('Balalaika\\Action', 'Action', $config['object']),
                'field' => isset($config['field']) ? $config['field'] : null,
            );
        }

        return $options;
    }

    public function build($data) {
        $this->data = $data;

        $promotion = new Promotion($data['name']);

        if ($data['has_code']) {
            $this->activators['code']
              ->code($data['submitted_code'])
              ->usageLimitPerCode($data['usage_limit_per_code'])
              ->usageLimitPerUser($data['usage_limit_per_user']);
        }
        $this->activators['date_range']->start($data['start'])->end($data['end']);
        $promotion->setActivators($this->activators);

        $rules = array();
        foreach ($data['rules'] as $index => $rule) {
            $name = $rule['component_name'];
            $current = clone $this->rules[$name]['object'];
            $current->initialize($rule['operator'], $rule['value']);
            $rules[] = $current;
        }
        $promotion->setRules($rules);

        $actions = array();
        foreach ($data['actions'] as $index => $action) {
            $name = $action['component_name'];
            $current = clone $this->actions[$name]['object'];
            // Quite hacky, because all actions are stored in the same table
            // the argument column has type ambiguity.
            $current->initialize(intval($action['argument']));
            $actions[] = $current;
        }
        $promotion->setActions($actions);

        return $promotion;
    }
}
