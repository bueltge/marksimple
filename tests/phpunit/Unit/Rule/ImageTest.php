<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class ImageTest extends AbstractRuleTestCase
{

    public function provideList(): array
    {
        return [
            'image' => [
                '![String](path/to/image.png)',
                '<img src="path/to/image.png" />',
            ],
            'imagealt' => [
                '![String](path/to/image.png "Alt string")',
                '<img src="path/to/image.png" alt="Alt string" />',
            ],
        ];
    }

    public function returnRule(): ElementRuleInterface
    {
        return new Rule\Image();
    }
}
