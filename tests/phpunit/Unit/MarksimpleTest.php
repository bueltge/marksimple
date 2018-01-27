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

        $content = '# Great playground.';
        $result = '<h1 id="greatplayground">Great playground.</h1>';

        $testmd = new Marksimple();
        $testmd->removeAllRules();
        $testmd->addRule('header', new Rule\Header());
        $testee = $testmd->parse($content);
        static::assertSame($result, $testee);
    }
}