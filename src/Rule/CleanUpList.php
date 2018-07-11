<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class CleanUpList extends AbstractRegexRule
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Clean up unordered list blocks to get for a block only one ul, ol block,
     * not each line and leave the li element.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#\s*<\/(ol|ul)>\n<\1>\s*#';
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $content): string
    {
        return "\n";
    }
}
