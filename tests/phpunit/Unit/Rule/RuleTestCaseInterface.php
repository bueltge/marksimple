<?php # -*- coding: utf-8 -*-
declare( strict_types = 1 );

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule\ElementRuleInterface;

interface RuleTestCaseInterface
{

    public function testee(): ElementRuleInterface;

    public function provideData(): array;
}