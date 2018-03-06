<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class NewLine extends AbstractRegexRule
{

    /**
     * Get the regex rule to identify the fromFile for the callback.
     * Leave br as new line helper, only on break with html > before.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#(?!>).&lt;br&gt;#';
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $content): string
    {
        return "\n<br>" . $content[ 0 ];
    }
}
