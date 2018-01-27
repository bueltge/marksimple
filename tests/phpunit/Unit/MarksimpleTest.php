<?php # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit;

use Bueltge\Marksimple\Marksimple;

class MarksimpleTest extends AbstractTestCase
{

    /**
     * Create the class an Object?
     */
    public function testBasic()
    {

        $testee = new Marksimple();
        static::assertInternalType('object', $testee);
    }
}
