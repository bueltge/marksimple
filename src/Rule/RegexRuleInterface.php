<?php

declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

interface RegexRuleInterface extends ElementRuleInterface
{

    /**
     * @return string    RegEx rule
     */
    public function rule(): string;
}
