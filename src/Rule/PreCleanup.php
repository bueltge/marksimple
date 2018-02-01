<?php # -*- coding: utf-8 -*-
declare( strict_types = 1 );

namespace Bueltge\Marksimple\Rule;

class PreCleanup implements ElementRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Clean up code blocks to leave only one open/close pre for each block.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#<\/code><\/pre>\n<pre><code(>| .*?>)#';
    }

    /**
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        return '<br>';
    }
}
