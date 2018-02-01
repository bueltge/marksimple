<?php # -*- coding: utf-8 -*-
declare( strict_types = 1 );

namespace Bueltge\Marksimple\Rule;

class NewLine implements ElementRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Leave br as new line helper, only on break with html > before.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#(?!>).&lt;br&gt;#';
    }

    /**
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        return '\n<br>';
    }
}
