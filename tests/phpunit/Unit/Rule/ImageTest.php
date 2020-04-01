<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class ImageTest extends AbstractRuleTestCase
{

    public function provideList()
    {

        $input    = '![String](path/to/image.png)';
        $expected = '<img src="path/to/image.png" />';
        yield 'image' => [$input, $expected];

        $text = 'Lorum ipsum';
        yield 'text before' => ["text $input", "text $expected"];
        yield 'text after' => ["$input $text", "$expected $text"];
        yield 'text before and after' => ["$text $input $text", "$text $expected $text"];

        yield 'image with alt' => [
            '![String](path/to/image.png "Alt string")',
            '<img src="path/to/image.png" alt="Alt string" />',
        ];
    }

    public function returnRule(): Rule\ElementRuleInterface
    {

        return new Rule\Image();
    }
}
