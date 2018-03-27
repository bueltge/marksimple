<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class PreTest extends AbstractRuleTestCase
{

    public function returnRule(): ElementRuleInterface
    {

        return new Rule\Pre();
    }

    public function provideList()
    {

        yield 'prespace' => ['    Code block', '<pre><code>Code block</code></pre>'];
        yield 'pretab' => ['	Code block', '<pre><code>Code block</code></pre>'];
    }
}
