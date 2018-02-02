<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Link implements ElementRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Links without possibility to add javascript, XSS topic.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#\[([^\[]+)\]\((?:javascript:)?([^\)]+)\)(?!`)#';
    }

    /**
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        return '<a href="' . $content[ 2 ] . '">' . $content[ 1 ] . '</a>';
    }
}
