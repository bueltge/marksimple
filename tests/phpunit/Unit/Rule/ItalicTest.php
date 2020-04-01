<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class ItalicTest extends AbstractRuleTestCase
{

    public function provideList()
    {

        yield 'underline' => ['_Content in italic_', '<em>Content in italic</em>'];

        $input    = '*Content in italic*';
        $expected = '<em>Content in italic</em>';
        yield 'asterix' => [$input, $expected];

        $text = 'Lorum ipsum';
        yield 'text before' => ["$text $input", "$text $expected"];
        yield 'text after' => ["$input $text", "$expected $text"];
        yield 'text before and after' => ["$text $input $text", "$text $expected $text"];
    }

    public function returnRule(): ElementRuleInterface
    {

        return new Rule\Italic();
    }
}
