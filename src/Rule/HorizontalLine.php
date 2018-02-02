<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class HorizontalLine implements ElementRuleInterface
{

    protected $rules = [
        '***',
        '*****',
        '- - -',
        '---',
        '---------------------------------------',
    ];

    /**
     * {@inheritdoc}
     */
    public function parse(string $content): string
    {
        return str_replace($this->rules, '<hr/>', $content);
    }
}
