<?php

namespace Balalaika\Entity\Activator;

use Balalaika\TestPromotionSubject;

class ActivatorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->subject = new TestPromotionSubject();
        $this->date_range = new DateRangeActivator();
        $this->code = new CodeActivator();
    }

    public function testDateRangeIsActiveWhenNull()
    {
        $this->assertTrue($this->date_range->isActive($this->subject));
    }

    public function testFullDateRange()
    {
        $this->date_range->start('2014-05-01')->end('2014-07-01');
        $this->assertTrue($this->date_range->isActive($this->subject));

        $this->date_range->start('2013-05-01')->end('2013-07-01');
        $this->assertFalse($this->date_range->isActive($this->subject));
    }

    public function testStartDateRange()
    {
        $this->date_range->start('2014-05-01');
        $this->assertTrue($this->date_range->isActive($this->subject));

        $this->date_range->start('2015-05-01');
        $this->assertFalse($this->date_range->isActive($this->subject));
    }

    public function testEndDateRange()
    {
        $this->date_range->end('2014-05-07');
        $this->assertTrue($this->date_range->isActive($this->subject));

        $this->date_range->end('2014-05-01');
        $this->assertFalse($this->date_range->isActive($this->subject));
    }

    public function testCodeMatches()
    {
        $this->code->code('ABC');
        $this->assertTrue($this->code->isActive($this->subject));
    }

    public function testCodeUsageLimits()
    {
        $this->code->code('ABC')->usageLimitPerCode(20);
        $this->assertTrue($this->code->isActive($this->subject));

        $this->code->usageLimitPerUser(5);
        $this->assertTrue($this->code->isActive($this->subject));
    }
}
