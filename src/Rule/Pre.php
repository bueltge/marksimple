<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Pre implements ElementRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Code blocks via 4 spaces or tab.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#^(?:\0(.*?)\0\n)?( {4}|\t)(.*?)$#m';
    }

    /**
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        return sprintf('<pre><code>%s</code></pre>', $content[2] . $content[3]);
    }
}
