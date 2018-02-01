<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class UnorderedList implements ElementRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * ul List via star *.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#^ *[*\-+] +(.*?)$#m';
    }

    /**
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        return sprintf('<ul><li>%s</li></ul>', trim($content[1]));
    }
}
