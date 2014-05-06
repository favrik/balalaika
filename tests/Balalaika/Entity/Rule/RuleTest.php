<?php

namespace Balalaika\Entity\Rule;

use Balalaika\Entity\PromotionSubjectInterface;
use Balalaika\TestPromotionSubject;

class RuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Get a test promotion subject.
     *
     * @return TestPromotionSubject
     */
    private function getSubject()
    {
        return new TestPromotionSubject();
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testConstructorWithNoParameters()
    {
        $rule = new BaseRule();
    }

    /**
     * @expectedException Exception
     */
    public function testConstructorInvalidOperator()
    {
        $rule = new BaseRule('--', 'Something to compare');
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testIsValidMethodParameter()
    {
        $rule = new BaseRule('null', 'First time customer');
        $this->assertFalse($rule->isValid('subject'));
    }

    public function testBaseRuleIsAlwaysInvalid()
    {
        $rule = new BaseRule('null', 'First time customer');
        $this->assertFalse($rule->isValid($this->getSubject()));
    }

    public function testSimpleHumanName()
    {
        $rule = new BaseRule('null', 'Lala');
        $this->assertEquals('Base', $rule->getName());
    }

    public function testLongerHumanName()
    {
        $rule = new OrderTotalRule('>', 100);
        $this->assertEquals('Order Total', $rule->getName());
    }

    public function testOrderTotal()
    {
        // Equal
        $rule = new OrderTotalRule('=', 100);
        $this->assertTrue($rule->isValid($this->getSubject()));
        $rule->val(20);
        $this->assertFalse($rule->isValid($this->getSubject()));

        // Greater than
        $rule->op('>')->val(80);
        $this->assertTrue($rule->isValid($this->getSubject()));
        $rule->val(100);
        $this->assertFalse($rule->isValid($this->getSubject()));

        // Lesser than
        $rule->op('<')->val(150);
        $this->assertTrue($rule->isValid($this->getSubject()));
        $rule->val(90);
        $this->assertFalse($rule->isValid($this->getSubject()));
    }

    public function testList()
    {
        $rule = new UserIsRule('in', array(1));
        $this->assertTrue($rule->isValid($this->getSubject()));
        $rule->val(array(0));
        $this->assertFalse($rule->isValid($this->getSubject()));

        $rule->op('not in');
        $this->assertTrue($rule->isValid($this->getSubject()));
        $rule->val(array(1));
        $this->assertFalse($rule->isValid($this->getSubject()));

        $rule = new ZipcodeIsRule('in', array(92231));
        $this->assertTrue($rule->isValid($this->getSubject()));
    }

    public function testFirstTimeCustomer()
    {
        $rule = new FirstTimeCustomerRule(1);
        $this->assertTrue($rule->isValid($this->getSubject()));
        $rule->op(0);
        $this->assertFalse($rule->isValid($this->getSubject()));
    }
}
