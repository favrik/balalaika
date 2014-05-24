<?php

namespace Balalaika\Entity;

use Balalaika\Entity\Rule\OrderTotalRule;
use Balalaika\Entity\Activator\CodeActivator;
use Balalaika\Action\DiscountFixedAmountAction;
use Balalaika\Action\FreeShippingAction;
use Balalaika\TestPromotionSubject;

class PromotionTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $promotion = new Promotion('Name');
        $this->assertEquals('Name', $promotion->getName());
    }

    public function testSettingRules()
    {
        $rule = new OrderTotalRule();
        $rule->initialize('>', 80);

        $promotion = new Promotion('Name');
        $promotion->setRules(array($rule));
        $this->assertTrue($promotion->isEligible(new TestPromotionSubject()));
    }

    public function testSettingActivators()
    {
        $promotion = new Promotion('Lala');
        $codeActivator = new CodeActivator();
        $codeActivator->code('XYZ');
        $promotion->setActivators(array($codeActivator));
        $this->assertFalse($promotion->isEligible(new TestPromotionSubject()));
    }

    public function testPromotionApply()
    {
        $discountAction = new DiscountFixedAmountAction();
        $discountAction->initialize(20);

        $actions = array(
            $discountAction,
            new FreeShippingAction()
        );

        $subjectMock = $this->getMock('\Balalaika\TestPromotionSubject', array('addOrderDiscount', 'setFreeShipping'));
        $subjectMock->expects($this->once())->method('addOrderDiscount');
        $subjectMock->expects($this->once())->method('setFreeShipping');

        $promotion = new Promotion('Lala');
        $promotion->setActions($actions);

        $this->assertTrue($promotion->isEligible($subjectMock));

        $promotion->apply($subjectMock);
    }
}
