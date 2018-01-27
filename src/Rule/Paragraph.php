<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Paragraph implements ElementRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Parse the new line \n\n (only after sanitize fct; aon default is \r\n) only,
     *  if we have characters before and get the p-markup.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#\n([^<>\n;]+?)\n#';
    }

    /**
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        return sprintf('<p>%s</p>', $content[0]);
    }
}
