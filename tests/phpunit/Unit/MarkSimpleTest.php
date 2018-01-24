<?php # -*- coding: utf-8 -*-

namespace Bueltge\MarkSimple\Tests\Unit;

use Bueltge\MarkSimple\MarkSimple;
use MyProject\Container;

class MarkSimpleTest extends AbstractTestCase {

	public function test_basic() {

		$testee = new MarkSimple( '' );
		static::assertInstanceOf( Container::class, $testee );
	}

	public function test_construct() {

		$content = '';
		$testee = new MarkSimple( $content );
		static::assertSame( $content, $testee );
	}
}