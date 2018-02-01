<?php # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Marksimple;
use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Tests\Unit\AbstractTestCase;

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
            $testee = $testmd->getMarkdown($italic);
            static::assertSame($result, $testee);
        }
    }
}
