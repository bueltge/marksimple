<?php # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class UnorderedListTest extends AbstractRuleTestCase
{

    public function provideList(): array
    {
        return [
            'first' => ['* List Element', '<ul><li>List Element</li></ul>'],
            'second' => ['- List Element', '<ul><li>List Element</li></ul>'],
        ];
    }

    public function returnRule(): ElementRuleInterface
    {
        return new Rule\UnorderedList();
    }
}
