<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class CleanUpListTest extends AbstractRuleTestCase
{

    public function provideList()
    {
        yield 'cleanuplist' => ["</ul>\n<ul>", "\n"];
        yield 'cleanuplist' => ["</ol>\n<ol>", "\n"];
    }

    public function returnRule(): ElementRuleInterface
    {
        return new Rule\CleanUpList();
    }
}
