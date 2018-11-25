<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit;

use Bueltge\Marksimple\Exception\UnknownRuleException;
use Bueltge\Marksimple\Marksimple;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Exception;
use Psr\Log\NullLogger;

class MarksimpleTest extends AbstractTestCase
{

    public function testBasic()
    {
        $testee = new Marksimple();
        try {
            static::assertInternalType('object', $testee);
        } catch (Exception $e) {
        }
    }

    public function testAddRule()
    {
        $expectedName = 'foo';

        $stub = $this->getMockBuilder(ElementRuleInterface::class)->getMock();

        $testee = new Marksimple();

        try {
            static::assertFalse($testee->hasRule($expectedName));
        } catch (AssertionFailedError $e) {
        }

        $testee->addRule($expectedName, $stub);

        try {
            static::assertTrue($testee->hasRule($expectedName));
        } catch (AssertionFailedError $e) {
        }
    }

    public function testRemoveRule()
    {
        $expected_name = 'foo';

        $stub = $this->getMockBuilder(ElementRuleInterface::class)->getMock();

        $testee = new Marksimple();
        $testee->addRule($expected_name, $stub);
        try {
            static::assertTrue($testee->removeRule($expected_name));
        } catch (UnknownRuleException $e) {
        } catch (AssertionFailedError $e) {
        }
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
        $expected = '<p>'.$input.'</p>';
        static::assertSame($expected, $testee->parse($input));
    }

    public function testGetLogger()
    {
        $markSimple = new Marksimple();

        try {
            $this->assertInstanceOf(NullLogger::class, $markSimple->getLogger());
        } catch (Exception $e) {
        }
    }
}
