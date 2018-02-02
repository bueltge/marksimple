<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class HorizontalLine implements ElementRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Horizontal line via ---.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#\n-{3,}#';
    }

    /**
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        return '<hr>' . $content[ 0 ];
    }
}
