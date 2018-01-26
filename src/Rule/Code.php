<?php # -*- coding: utf-8 -*-
declare( strict_types = 1 );

namespace Bueltge\Marksimple\Rule;

class Code implements ElementRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Inline Code via `.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#(?<!\\\)`([^\n]+?)`#';
    }

    /**
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        return sprintf( '<code>%s</code>', $content[1] );
    }
}