<?php # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class ImageTest extends AbstractRuleTestCase
{

    public function provideList(): array
    {
        return [ /* TODO */];
    }

    protected function testee(): ElementRuleInterface
    {
        return new Rule\Image();
    }
}
