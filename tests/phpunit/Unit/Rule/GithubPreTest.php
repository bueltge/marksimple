<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class GithubPreTest extends AbstractRuleTestCase
{

    public function returnRule(): ElementRuleInterface
    {

        return new Rule\GithubPre();
    }

    public function provideList()
    {

        $input    = <<<MARKDOWN
```
Code block
```
MARKDOWN;
        $expected = '<pre><code>Code block</code></pre>';

        yield 'simple' => [ $input, $expected ];

        $text = 'Lorum ipsum';
        yield 'text before' => ["$text \n $input", "$text $expected"];
        yield 'text after' => ["$input \n $text", "$expected $text"];
        yield 'text before and after' => ["$text \n $input \n $text", "$text $expected $text"];

        $input = <<<MARKDOWN
```php
<?php
// Code block
```
MARKDOWN;
        yield  'githubprewithlang' => [
            $input,
            '<pre><code class="php language-php">&lt;?php<br>// Code block</code></pre>'
        ];
    }

}
