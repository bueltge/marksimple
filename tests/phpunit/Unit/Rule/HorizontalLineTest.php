<?php # -*- coding: utf-8 -*-

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
                'Lorem ipsum dolor sit amet --- consetetur sadipscing elitr',
                'Lorem ipsum dolor sit amet <hr/> consetetur sadipscing elitr'
            ]
        ];
    }

    protected function testee(): ElementRuleInterface
    {
        return new Rule\HorizontalLine();
    }
}
