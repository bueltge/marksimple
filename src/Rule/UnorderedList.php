<?php

declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class UnorderedList extends AbstractRegexRule
{

    /**
     * Get the regex rule to identify the content for the callback.
     * ul List via star * or -.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#^ *[*\-+] +(.*?)$#m';
    }

    /**
     * {@inheritdoc}
     */
    protected function render(array $content): string
    {
        return sprintf('<ul><li>%s</li></ul>', trim($content[1]));
    }
}
