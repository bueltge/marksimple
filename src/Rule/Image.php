<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Image implements ElementRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Parse image with optional alt string, like ![String](path/to/image.png "Alt string")
     *
     * @return string
     */
    public function rule(): string
    {
        // (?!`) for don't match with ` on end of line for code lines.
        return '#!\[[^\]]*\]\((.*?)(?=\"|\))(\".*\")?\)(?!`)#';
    }

    /**
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        $url = filter_var($content[1], FILTER_SANITIZE_URL);
        $alt = isset($content[2]) ? filter_var($content[2], FILTER_SANITIZE_STRING) : '';

        return sprintf('<img src="%s" alt="%s" />', $url, $alt);
    }
}
