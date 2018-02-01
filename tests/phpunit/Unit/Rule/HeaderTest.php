<?php # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Marksimple;
use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Tests\Unit\AbstractTestCase;

class HeaderTest extends AbstractTestCase
{

    /**
     * Test h1 include add if an id to h1 markup.
     */
    public function testHeader()
    {

        // Define Markdown examples and his assert result with html.
        $headers = [
            '# Great playground.' => '<h1 id="greatplayground">Great playground.</h1>',
            '## Great playground.' => '<h2 id="greatplayground">Great playground.</h2>',
            '### Great playground.' => '<h3 id="greatplayground">Great playground.</h3>',
            '#### Great playground.' => '<h4 id="greatplayground">Great playground.</h4>',
            '##### Great playground.' => '<h5 id="greatplayground">Great playground.</h5>',
            '###### Great playground.' => '<h6 id="greatplayground">Great playground.</h6>',
        ];

        $testmd = new Marksimple();
        $testmd->removeAllRules();
        $testmd->addRule('header', new Rule\Header());
        foreach ($headers as $header => $result) {
            $testee = $testmd->getMarkdown($header);
            static::assertSame($result, $testee);
        }
    }
}
