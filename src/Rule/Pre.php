<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Pre extends AbstractRegexRule
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Code blocks via 4 spaces or tab.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#^(?:\0(.*?)\0\n)?( {4}|\t)(.*?)$#m';
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $content): string
    {
        $content = sprintf('<pre><code>%s</code></pre>', $content[3]);
        return $content;
    }
}
