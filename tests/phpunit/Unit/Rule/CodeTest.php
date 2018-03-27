<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class CodeTest extends AbstractRuleTestCase
{

    public function returnRule(): ElementRuleInterface
    {

        return new Rule\Code();
    }

    public function provideList()
    {


        yield 'simple' => ['`code`', '<code>code</code>'];

        yield 'multiple gravis' => ['```', '<code>`</code>'];

        yield 'encode tags withing' => ['`<br/>`', '<code>&lt;br/&gt;</code>'];

        $text     = 'Lorum ipsum';
        $input    = '`<br/>`';
        $expected = '<code>&lt;br/&gt;</code>';
        yield 'text before' => ["$text\n$input", "$text\n$expected"];
        yield 'text after' => ["$input\n$text", "$expected\n$text"];
        yield 'text before and after' => ["$text\n$input\n$text", "$text\n$expected\n$text"];
    }
}
