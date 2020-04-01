<?php # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class UnorderedListTest extends AbstractRuleTestCase
{

    public function returnRule(): ElementRuleInterface
    {

        return new Rule\UnorderedList();
    }

    public function provideList()
    {

        yield 'asterix' => ['* List Element', '<ul><li>List Element</li></ul>'];

        $input    = '- List Element';
        $expected = '<ul><li>List Element</li></ul>';
        $text     = 'Lorum ipsum';
        yield 'minus' => [$input, $expected];

        yield 'text before' => ["$text\n$input", "$text\n$expected"];
        yield 'text after' => ["$input\n$text", "$expected\n$text"];
        yield 'text before and after' => ["$text\n$input\n$text", "$text\n$expected\n$text"];

        $input = <<<Markdown
* item 1
* item 2
* item 3
Markdown;

        $expected = '<ul><li>item 1</li></ul>
<ul><li>item 2</li></ul>
<ul><li>item 3</li></ul>';
        yield 'multiple items' => [$input, $expected];
    }
}
