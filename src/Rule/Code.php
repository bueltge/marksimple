<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Code extends AbstractRegexRule
{

    /**
     * {@inheritdoc}
     */
    public function rule(): string
    {
        return '#(?<!\\\)`([^\n]+?)`#';
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $content): string
    {
        return sprintf('<code>%s</code>', $content[1]);
    }
}
