<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class CodeTest extends AbstractRuleTestCase
{

    public function provideList(): array
    {
        return [
            'simple' => ['`code`', '<code>code</code>'],
            'multiple gravis' => ['```', '<code>`</code>'],
            'encode tags withing' => ['`<br>`', '<code>&lt;br&gt;</code>'],
        ];
    }

    public function testee(): ElementRuleInterface
    {
        return new Rule\Code();
    }
}
