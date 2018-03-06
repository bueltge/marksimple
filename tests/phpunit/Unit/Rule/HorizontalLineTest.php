<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class HorizontalLineTest extends AbstractRuleTestCase
{

    public function provideList(): array
    {
        return [
            'normal horizontal line' => [
                'Line
---',
                'Line
<hr>',
            ],
        ];
    }

    public function returnRule(): ElementRuleInterface
    {
        return new Rule\HorizontalLine();
    }
}
