<?php

namespace Balalaika\Action;

use Balalaika\Action\DiscountFixedAmountAction;
use Balalaika\Action\DiscountPercentageAction;
use Balalaika\TestPromotionSubject;

class ActionTest extends \PHPUnit_Framework_TestCase
{
    public function getSubjectMock($methods = array())
    {
        if (!is_array($methods)) {
            $methods = array($methods);
        }

        return $this->getMock('\Balalaika\TestPromotionSubject', $methods);
    }

    public function testDiscountFixedAmount()
    {
        $subjectMock = $this->getSubjectMock('addOrderDiscount');
        $subjectMock->expects($this->once())->method('addOrderDiscount');

        $action = new DiscountFixedAmountAction(40);
        $action->perform($subjectMock);

        $subject = new TestPromotionSubject();
        $action->perform($subject);
        $this->assertEquals(60, $subject->getOrderTotal());
    }

    public function testDiscountFixedAmountInvalidParameter()
    {
        $subjectMock = $this->getSubjectMock('addOrderDiscount');
        $subjectMock->expects($this->never())->method('addOrderDiscount');

        $action = new DiscountFixedAmountAction('orale');
        $action->perform($subjectMock);
    }

    public function testDiscountPercentageAction()
    {
        $subjectMock = $this->getSubjectMock(array('addOrderDiscount', 'getProductTotal'));
        $subjectMock->expects($this->once())->method('addOrderDiscount');
        $subjectMock->expects($this->once())->method('getProductTotal');

        $action = new DiscountPercentageAction(20);
        $action->perform($subjectMock);

        $subject = new TestPromotionSubject();
        $action->perform($subject);
        $this->assertEquals(84, $subject->getOrderTotal());
    }

    public function testFreeShippingAction()
    {
        $subjectMock = $this->getSubjectMock('setFreeShipping');
        $subjectMock->expects($this->once())->method('setFreeShipping');

        $action = new FreeShippingAction();
        $action->perform($subjectMock);
    }
}

