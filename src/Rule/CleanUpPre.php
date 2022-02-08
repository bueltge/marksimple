<?php

declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class CleanUpPre extends AbstractRegexRule
{
    /**
     * Get the regex rule to identify the content for the callback.
     * Clean up pre code blocks to get for a block only one pre code block, not each line.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#<\/code><\/pre>\n<pre><code(>| .*?>)#';
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $content): string
    {
        return '<br>';
    }
}
