<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class CleanUpListTest extends AbstractRuleTestCase
{

    public function provideList()
    {
        $text = 'Lorum Ipsum';
        yield 'noreplacement' => ['</ul><ul>', '</ul><ul>'];
        yield 'cleanupulist' => ["</ul>\n<ul>", "\n"];
        yield 'cleanupolist' => ["$text</ol>\n<ol>", "$text\n"];
    }

    public function returnRule(): ElementRuleInterface
    {
        return new Rule\CleanUpList();
    }
}
