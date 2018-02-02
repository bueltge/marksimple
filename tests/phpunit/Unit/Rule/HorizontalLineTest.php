<?php # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class HorizontalLineTest extends AbstractRuleTestCase
{

    public function provideList(): array
    {
        return [ /* TODO */];
    }

    protected function get_testee(): ElementRuleInterface
    {
        return new Rule\HorizontalLine();
    }
}
