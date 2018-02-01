<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Header implements ElementRuleInterface
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
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        /** @noinspection PhpUnusedLocalVariableInspection */
        list($temp, $char, $header) = $content;
        $headingLevel = \strlen($char);
        $header = trim($header);
        // Build anker without space, numbers.
        $anker = preg_replace('#[^a-z?!]#', '', strtolower($header));

        return sprintf('<h%d id="%s">%s</h%d>', $headingLevel, $anker, $header, $headingLevel);
    }
}
