<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class LinkTest extends AbstractRuleTestCase
{

    public function provideList()
    {

        $input    = '[link](url)';
        $expected = '<a href="url">link</a>';
        $text     = 'Lorum ipsum';

        yield 'simple' => [$input, $expected];
        yield 'text before' => ["$text $input", "$text $expected"];
        yield 'text after' => ["$input $text", "$expected $text"];
        yield 'text before and after' => ["$text $input $text", "$text $expected $text"];

    }

    public function returnRule(): ElementRuleInterface
    {

        return new Rule\Link();
    }
}
