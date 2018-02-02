<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Strong implements ElementRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Strong, bold via double star ** or double underline __.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#(?<!\\\)([*_]{2})([^\n]+?)\1#';
    }

    /**
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        return sprintf('<strong>%s</strong>', $content[ 2 ]);
    }
}
