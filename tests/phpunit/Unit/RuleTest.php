<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Tests\Unit;

use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Marksimple;
use Bueltge\Marksimple\Tests\Unit\Rule\RuleTestCaseInterface;

abstract class RuleTest extends AbstractTestCase implements RuleTestCaseInterface
{

    /**
     * Create the class an Object?
     */
    public function testBasic()
    {

        $testee = $this->testee();
        $this->assertInstanceOf(ElementRuleInterface::class, $testee);
        $this->noEmpty($testee->rule());
    }

    public function testData(string $input, string $expected)
    {

        $testee = new Marksimple();
        $testee->removeAllRules();
        $testee->addRule('rule', $this->testee());

        $this->assertSame($expected, $testee->getMarkdown($input));
    }
}
