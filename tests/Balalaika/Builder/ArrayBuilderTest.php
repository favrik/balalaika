<?php

namespace Balalaika\Builder;

use Balalaika\Builder\ArrayBuilder;

class ArrayBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $promotion = new ArrayBuilder(array());
        $this->assertEquals(1, 1);
    }
}
