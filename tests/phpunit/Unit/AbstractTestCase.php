<?php # -*- coding: utf-8 -*-

namespace Bueltge\MarkSimple\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Class AbstractTestCase
 */
abstract class AbstractTestCase extends TestCase {

	/**
	 * Sets up the environment.
	 *
	 * @return void
	 */
	protected function setUp() {
		parent::setUp();
	}

	/**
	 * Tears down the environment.
	 *
	 * @return void
	 */
	protected function tearDown() {
		parent::tearDown();
	}

}
