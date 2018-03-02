<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class StrongTest extends AbstractRuleTestCase
{

    public function provideList(): array
    {
        return [
            'star' => ['**Strong word**', '<strong>Strong word</strong>'],
            'underline' => ['__Strong word__', '<strong>Strong word</strong>'],
        ];
    }

    public function returnRule(): ElementRuleInterface
    {
        return new Rule\Strong();
    }
}
