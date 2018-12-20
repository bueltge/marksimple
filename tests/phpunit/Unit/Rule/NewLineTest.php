<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class NewLineTest extends AbstractRuleTestCase
{

    /**
     * @return array|\Generator
     */
    public function provideList()
    {
        $input = '&lt;br&gt;';
        $expected = '&lt;br&gt;';
        $text = 'Lorum ipsum';

        yield 'simple' => [$input, $expected];
        yield 'text before' => ["$text $input", "$text\n<br> $expected"];
        yield 'text after' => ["$input $text", "$expected $text"];
        yield 'text before and after' => ["$text $input $text", "$text\n<br> $expected $text"];
    }

    public function returnRule(): ElementRuleInterface
    {
        return new Rule\NewLine();
    }
}
