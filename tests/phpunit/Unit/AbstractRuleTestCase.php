<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit;

use Bueltge\Marksimple\Marksimple;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Rule\RegexRuleInterface;

abstract class AbstractRuleTestCase extends AbstractTestCase
{

    /**
     * Test basic bahavior of the rule class.
     */
    public function testBasic()
    {

        $testee = $this->returnRule();
        static::assertInstanceOf(ElementRuleInterface::class, $testee);

        if ($testee instanceof RegexRuleInterface) {
            static::assertNotEmpty($testee->rule());
        }
    }

    abstract public function returnRule(): ElementRuleInterface;

    /**
     * Test if rules are only triggered when text really contains special markdown.
     * Plain text shouldn't be changed by any rule.
     */
    public function testNoMarkdownContent()
    {

        $testee = new Marksimple();
        $testee->removeAllRules();
        $testee->addRule('rule', $this->returnRule());

        $input = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr,';
        $input .= ' diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam';
        static::assertSame($input, $testee->parse($input));
    }

    /**
     * @dataProvider provideList
     * @param string $input
     * @param string $expected
     */
    public function testList(string $input, string $expected)
    {

        $testee = new Marksimple();
        $testee->removeAllRules();
        $testee->addRule('rule', $this->returnRule());

        $output = $testee->parse($input);
        static::assertSame($expected, $output);
    }

    /**
     * Provide test data to test various combinations of input.
     *
     * @return array [ [ 'input text', 'expected output' ] ]
     */
    abstract public function provideList(): array;
}
