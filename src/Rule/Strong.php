<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Strong extends AbstractRegexRule implements RegexRuleInterface
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
     * {@inheritdoc}
     */
    public function render(array $content): string
    {
        return sprintf('<strong>%s</strong>', $content[ 2 ]);
    }
}
