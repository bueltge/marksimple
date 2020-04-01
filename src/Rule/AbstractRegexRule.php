<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Rule;

abstract class AbstractRegexRule implements RegexRuleInterface
{

    /**
     * {@inheritdoc}
     */
    public function parse(string $content): string
    {

        return preg_replace_callback($this->rule(), [$this, 'render'], $content);
    }

    abstract protected function render(array $content): string;
}
