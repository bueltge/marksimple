<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class CleanUpUl extends AbstractRegexRule
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Clean up unordered list blocks to get for a block only one ul block,
     * not each line and leave the li element.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#<\/li><\/ul>\n<ul><li(>| .*?>)#';
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $content): string
    {
        return '</li><li>';
    }
}
