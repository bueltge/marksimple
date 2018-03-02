<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class GithubPreTest extends AbstractRuleTestCase
{

    public function provideList(): array
    {
        return [
            'githubpre' => [
                '```php
Code block
```',
                '<pre><code class="php language-php">Code block</code></pre>',
            ],
        ];
    }

    public function returnRule(): ElementRuleInterface
    {
        return new Rule\GithubPre();
    }
}
