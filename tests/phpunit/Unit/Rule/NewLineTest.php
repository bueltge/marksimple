<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class NewLineTest extends AbstractRuleTestCase
{

    public function provideList(): array
    {
        return [
            'newline' => ['<br>', '&lt;br&gt;'],
            'newlinehtml' => [
                ' <br>', '
<br> &lt;br&gt;',
            ],
        ];
    }

    public function returnRule(): ElementRuleInterface
    {
        return new Rule\NewLine();
    }
}
