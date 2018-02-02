<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Header extends AbstractRegexRule implements RegexRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Header h1 - h6.
     *
     * @return string
     */
    public function rule(): string
    {
        return '#^(\#{1,6})\s*([^\#]+?)\s*\#*$#m';
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $content): string
    {
        $headingLevel = \strlen($content[1]);
        $header       = trim($content[2]);
        // Build anker without space, numbers.
        $anker = preg_replace('#[^a-z?!]#', '', strtolower($header));

        return sprintf('<h%d id="%s">%s</h%d>', $headingLevel, $anker, $header, $headingLevel);
    }
}
