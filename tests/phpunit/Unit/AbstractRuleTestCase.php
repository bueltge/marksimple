<?php # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit;

use Bueltge\Marksimple\Marksimple;
use Bueltge\Marksimple\Rule\ElementRuleInterface;

abstract class AbstractRuleTestCase extends AbstractTestCase
{

    /**
     * Test basic bahavior of the rule class.
     */
    public function testBasic()
    {

        $testee = $this->get_testee();
        static::assertInstanceOf(ElementRuleInterface::class, $testee);
        static::assertNotEmpty($testee->rule());
    }

    /**
     * Test if rules are only triggered when text really contains special markdown.
     * Plain text shouldn't be changed by any rule.
     */
    public function testNoMarkdownContent()
    {

        $testee = new Marksimple();
        $testee->removeAllRules();
        $testee->addRule('rule', $this->get_testee());

        $input    = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam';
        $expected = '<p>' . $input . '</p>';
        static::assertSame($expected, $testee->parse($input));
    }

    /**
     * @dataProvider provideList
     */
    public function testList(string $input, string $expected)
    {

        $testee = new Marksimple();
        $testee->removeAllRules();
        $testee->addRule('rule', $this->get_testee());

        static::assertSame($expected, $testee->parse($input));
    }

    /**
     * Provide test data to test various combinations of input.
     *
     * @return array [ [ 'input text', 'expected output' ] ]
     */
    abstract public function provideList(): array;

    abstract protected function get_testee(): ElementRuleInterface;
}