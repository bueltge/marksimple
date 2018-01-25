<?php

class Header implements ElementRuleInterface
{

    public function rule(): string
    {
        return '#^(\#{1,6})\s*([^\#]+?)\s*\#*$#m';
    }

    public function render(array $content): string
    {
        /** @noinspection PhpUnusedLocalVariableInspection */
        list($temp, $char, $header) = $content;
        $heading_level = \strlen($char);
        $header = trim($header);
        // Build anker without space, numbers.
        $anker = preg_replace('#[^a-z?!]#', '', strtolower($header));

        return sprintf('<h%d id="%s">%s</h%d>', $heading_level, $anker, $header, $heading_level);
    }
}