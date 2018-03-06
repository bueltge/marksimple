<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Image extends AbstractRegexRule
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
     * {@inheritdoc}
     */
    public function render(array $content): string
    {
        $url = filter_var($content[1], FILTER_SANITIZE_URL);
        $alt = '';
        if (isset($content[2])) {
            $content[2] = str_replace('"', '', $content[2]);
            $alt = ' alt="' . filter_var($content[2], FILTER_SANITIZE_STRING) . '"';
        }

        return sprintf('<img src="%s"%s />', $url, $alt);
    }
}
