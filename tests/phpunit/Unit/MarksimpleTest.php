<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit;

use Bueltge\Marksimple\Marksimple;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Psr\Log\NullLogger;

class MarksimpleTest extends AbstractTestCase
{

    public function testBasic()
    {

        $testee = new Marksimple();
        static::assertInternalType('object', $testee);
    }


    public function testAddRule()
    {

        $expected_name = 'foo';

        $stub = $this->getMockBuilder(ElementRuleInterface::class)->getMock();

        $testee = new Marksimple();

        static::assertFalse($testee->hasRule($expected_name));

        $testee->addRule($expected_name, $stub);

        static::assertTrue($testee->hasRule($expected_name));
    }

    public function testRemoveRule()
    {

        $expected_name = 'foo';

        $stub = $this->getMockBuilder(ElementRuleInterface::class)->getMock();

        $testee = new Marksimple();
        $testee->addRule($expected_name, $stub);
        static::assertTrue($testee->removeRule($expected_name));
    }

    /**
     * @expectedException \Bueltge\Marksimple\Exception\UnknownRuleException
     */
    public function testRemoveUnknownRule()
    {

        (new Marksimple())->removeRule('unknown_rule');
    }

    /**
     * Test if basic text input will be parsed and wrapped by paragraphs.
     */
    public function testParse()
    {
        $testee = new Marksimple();
        $input = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr,';
        $input .= ' diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam';
        $expected = '<p>' . $input . '</p>';
        static::assertSame($expected, $testee->parse($input));
    }

    public function testGetLogger()
    {
        $markSimple = new Marksimple();

        $this->assertInstanceOf(NullLogger::class, $markSimple->getLogger());
    }
}
