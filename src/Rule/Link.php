<?php # -*- coding: utf-8 -*-
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
        return '<a href="' . $content[2] . '">' . $content[1] . '</a>';
    }
}
