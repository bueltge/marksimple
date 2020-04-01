<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class StrongTest extends AbstractRuleTestCase
{

    public function returnRule(): ElementRuleInterface
    {

        return new Rule\Strong();
    }

    public function provideList()
    {

        yield 'star' => ['**Strong word**', '<strong>Strong word</strong>'];

        $input    = '__Strong word__';
        $expected = '<strong>Strong word</strong>';
        $text     = 'Lorum ipsum';
        yield 'underline' => [$input, $expected];

        yield 'text before' => ["$text $input", "$text $expected"];
        yield 'text after' => ["$input $text", "$expected $text"];
        yield 'text before and after' => ["$text $input $text", "$text $expected $text"];
    }
}
