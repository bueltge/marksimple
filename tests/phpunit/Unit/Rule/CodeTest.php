<?php # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit;

use Bueltge\Marksimple\Marksimple;
use Bueltge\Marksimple\Rule;

class CodeTest extends AbstractTestCase
{

    /**
     * Test inline code, that's marked via `
     */
    public function testCode()
    {
        $codes = [
            '`code`' => '<code>code</code>',
            '```' => '<code>`</code>',
            '`<br>`' => '<code>&lt;br&gt;</code>',
        ];

        $testmd = new Marksimple();
        $testmd->removeAllRules();
        $testmd->addRule('code', new Rule\Code());
        foreach ($codes as $code => $result) {
            $testee = $testmd->parse($code);
            static::assertSame($result, $testee);
        }
    }
}
