<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Italic extends AbstractRegexRule implements RegexRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Italic formatting via one star * or one underline _.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#(?<!\\\)([*_])([^\n|`]+?)\1#';
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $content): string
    {
        return sprintf('<em>%s</em>', $content[ 2 ]);
    }
}
