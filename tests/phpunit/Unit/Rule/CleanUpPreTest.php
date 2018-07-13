<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class CleanUpPreTest extends AbstractRuleTestCase
{

    public function provideList()
    {
        //@ToDo Fix to run in real test, but currently function parse() user always sanitize and can't parse html.
        yield 'simple' => ["</code></pre>\n<pre><code>", "&lt;/code&gt;&lt;/pre&gt;\n&lt;pre&gt;&lt;code&gt;"];
    }

    public function returnRule(): ElementRuleInterface
    {
        return new Rule\CleanUpPre();
    }
}
