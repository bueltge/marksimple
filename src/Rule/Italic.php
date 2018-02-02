<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Italic implements ElementRuleInterface
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
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        return sprintf('<em>%s</em>', $content[ 2 ]);
    }
}
