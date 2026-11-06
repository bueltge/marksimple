<?php

declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Link extends AbstractRegexRule
{
    /**
     * Get the regex rule to identify the fromFile for the callback.
     * Links without possibility to add javascript, XSS topic.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#\[([^\[]+)\]\((?:javascript:)?([^\)]+)\)(?!`)#';
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $content): string
    {
        $url = $content[2];
        $normalizedUrl = preg_replace('/[\x00-\x20\x7f]+/', '', $url);

        if (
            preg_match('/^[a-z][a-z0-9+.-]*:/i', $normalizedUrl, $scheme) === 1
            && !in_array(strtolower(substr($scheme[0], 0, -1)), ['http', 'https', 'mailto'], true)
        ) {
            return $content[1];
        }

        $escapedUrl = htmlspecialchars($url, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', false);

        return '<a href="' . $escapedUrl . '">' . $content[1] . '</a>';
    }
}
