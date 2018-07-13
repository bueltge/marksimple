<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class HorizontalLine extends AbstractRegexRule
{

    /**
     * Get the regex rule to identify the fromFile for the callback.
     * Leave nh as horizontal line helper, only on lines without code ` before.
     *
     * @return string
     */
    public function rule(): string
    {
        return '/\n-{3,}/';
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $content): string
    {
        return "\n<hr/>";
    }
}
