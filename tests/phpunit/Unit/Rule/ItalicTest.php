<?php # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit;

use Bueltge\Marksimple\Marksimple;
use Bueltge\Marksimple\Rule;

class ItalicTest extends AbstractTestCase
{

    /**
     * We should get a hr markup from 3-, like ---.
     */
    public function testHorizontalLine()
    {

        $italics = [
            '_Content in italic_' => '<em>Content in italic</em>',
            '*Content in italic*' => '<em>Content in italic</em>',
        ];


        $testmd = new Marksimple();
        $testmd->removeAllRules();
        $testmd->addRule('italic', new Rule\Italic());
        foreach ($italics as $italic => $result) {
            $testee = $testmd->parse($italic);
            static::assertSame($result, $testee);
        }
    }
}