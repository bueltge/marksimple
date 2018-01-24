<?php # -*- coding: utf-8 -*-

namespace Bueltge\MarkSimple\Tests\Unit;

use Bueltge\MarkSimple\MarkSimple;
use MyProject\Container;

class MarkSimpleTest extends AbstractTestCase {

	/**
	 * Instance of ?
	 */
	public function test_basic() {

		$testee = new MarkSimple( '' );
		static::assertInstanceOf( Container::class, $testee );
	}

	/**
	 * Test constructor.
	 */
	public function test_construct() {

		$content = '';
		$testee = new MarkSimple( $content );
		static::assertSame( $content, $testee );
	}

	/**
	 * Test h1 include add if an id to h1 markup.
	 */
	public function test_header() {

		$content = '# I like this library.';
		$result  = '<h1 id="greatplayground">Great playground.</h1>';

		$testee = new MarkSimple( $content );
		static::assertSame( $result, $testee );
	}
}