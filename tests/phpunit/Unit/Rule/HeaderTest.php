<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class HeaderTest extends AbstractRuleTestCase
{

    public function provideList(): array
    {
        return [
            'h1' => ['# Great playground.', '<h1 id="greatplayground">Great playground.</h1>'],
            'h2' => ['## Great playground.', '<h2 id="greatplayground">Great playground.</h2>'],
            'h3' => ['### Great playground.', '<h3 id="greatplayground">Great playground.</h3>'],
            'h4' => ['#### Great playground.', '<h4 id="greatplayground">Great playground.</h4>'],
            'h5' => ['##### Great playground.', '<h5 id="greatplayground">Great playground.</h5>'],
            'h6' => ['###### Great playground.', '<h6 id="greatplayground">Great playground.</h6>'],
        ];
    }

    public function returnRule(): ElementRuleInterface
    {
        return new Rule\Header();
    }
}
