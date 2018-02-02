<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class UnorderedList extends AbstractRegexRule implements RegexRuleInterface
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
     * {@inheritdoc}
     */
    protected function render(array $content): string
    {
        $content = sprintf('<ul><li>%s</li></ul>', trim($content[ 1 ]));

        return preg_replace('\'#\s*<\/(ol|ul)>\n<\1>\s*#', '\n', $content);
    }
}
