<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class HeaderTest extends AbstractRuleTestCase
{

    public function provideList()
    {

        yield 'h1' => ['# Great playground.', '<h1 id="greatplayground">Great playground.</h1>'];
        yield 'h2' => ['## Great playground.', '<h2 id="greatplayground">Great playground.</h2>'];
        yield 'h3' => ['### Great playground.', '<h3 id="greatplayground">Great playground.</h3>'];
        yield 'h4' => ['#### Great playground.', '<h4 id="greatplayground">Great playground.</h4>'];
        yield 'h5' => ['##### Great playground.', '<h5 id="greatplayground">Great playground.</h5>'];

        $input    = '###### Great playground.';
        $expected = '<h6 id="greatplayground">Great playground.</h6>';
        yield 'h6' => [$input, $expected];

        $text = 'Lorum ipsum';
        yield 'text before' => ["$text\n$input", "$text\n$expected"];
        yield 'text after' => ["$input\n$text", "$expected\n$text"];
        yield 'text before and after' => ["$text\n$input\n$text", "$text\n$expected\n$text"];
    }

    public function returnRule(): ElementRuleInterface
    {

        return new Rule\Header();
    }
}
