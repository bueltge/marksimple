<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class HorizontalLineTest extends AbstractRuleTestCase
{

    public function returnRule(): ElementRuleInterface
    {

        return new Rule\HorizontalLine();
    }

    public function provideList()
    {

        $input    = '---';
        $expected = '<hr/>';

        yield 'simple' => [$input, $expected];

        $text = 'Lorum ipsum';
        yield 'text before' => ["$text\n$input", "$text\n$expected"];
        yield 'text after' => ["$input\n$text", "$expected\n$text"];
        yield 'text before and after' => ["$text\n$input\n$text", "$text\n$expected\n$text"];
    }

}
