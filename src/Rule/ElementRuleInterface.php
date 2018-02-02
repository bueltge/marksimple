<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

interface ElementRuleInterface
{

    /**
     * @param  string     context which has to be parsed
     * @return string    rendered element.
     */
    public function parse(string $content): string;
}
