<?php # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit;

use Bueltge\Marksimple\Marksimple;
use Bueltge\Marksimple\Rule;
use MyProject\Container;
use RuntimeException;

class MarksimpleTest extends AbstractTestCase
{

    /**
     * Instance of ?
     */
    public function testBasic()
    {

        $testee = new Marksimple();
        static::assertInternalType('object', $testee);
    }

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
            $testee = $testmd->parse($header);
            static::assertSame($result, $testee);
        }
    }

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