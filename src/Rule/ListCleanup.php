<?php # -*- coding: utf-8 -*-
declare( strict_types = 1 );

namespace Bueltge\Marksimple\Rule;

class ListCleanup implements ElementRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Clean up ol|ul li blocks to leave only start/end ul with li.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#\s*<\/(ol|ul)>\n<\1>\s*#';
    }

    /**
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        return "\n";
    }
}