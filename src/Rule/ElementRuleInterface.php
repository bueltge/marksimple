<?php

declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

interface ElementRuleInterface
{
    /**
     * @param  string $content Context which has to be parsed.
     * @return string Rendered element.
     */
    public function parse(string $content): string;
}
