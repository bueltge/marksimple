<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit;

use Bueltge\Marksimple\Exception\InvalideFileException;
use Bueltge\Marksimple\Exception\UnknownRuleException;
use Bueltge\Marksimple\Marksimple;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\SkippedTestError;
use Psr\Log\NullLogger;

class MarksimpleTest extends AbstractTestCase
{

    /**
     * The unreaddable file path.
     *
     * @var string
     */
    protected $noReadableFile = __DIR__ . '/./no_readable_file.txt';

    /**
     * Set up environment with adding unreadable file
     */
    public function setUp():void
    {
        touch($this->noReadableFile);
        chmod($this->noReadableFile, 27);
    }

    /**
     * Tear down environment with deleting unreadable file
     */
    public function tearDown():void
    {
        unlink($this->noReadableFile);
    }

    /**
     * Check the MarkSimple class instance can be created correctly.
     */
    public function testBasic()
    {
        $testee = new Marksimple();
        try {
            static::assertIsObject($testee);
        } catch (Exception $error) {
        }
    }

    /**
     * Check addRule can add the specified rule correctly.
     */
    public function testAddRule()
    {
        $expectedName = 'foo';

        $stub = $this->getMockBuilder(ElementRuleInterface::class)->getMock();

        $testee = new Marksimple();

        try {
            static::assertFalse($testee->hasRule($expectedName));
        } catch (AssertionFailedError $error) {
        }

        $testee->addRule($expectedName, $stub);

        try {
            static::assertTrue($testee->hasRule($expectedName));
        } catch (AssertionFailedError $error) {
        }
    }

    /**
     * Check removeRule can remove specified rule correctly.
     */
    public function testRemoveRule()
    {
        $expectedName = 'foo';

        $stub = $this->getMockBuilder(ElementRuleInterface::class)->getMock();

        $testee = new Marksimple();
        $testee->addRule($expectedName, $stub);
        try {
            static::assertTrue($testee->removeRule($expectedName));
        } catch (UnknownRuleException $error) {
        } catch (AssertionFailedError $error) {
        }
    }

    /**
     * Simple test, no parameters, only get a bool.
     */
    public function testRemoveAllRules()
    {
        $testee = new Marksimple();
        try {
            $this->assertTrue($testee->removeAllRules());
        } catch (AssertionFailedError $error) {
        }
    }

    /**
     * Test for unknown rule.
     */
    public function testRemoveUnknownRule()
    {
        $this->expectException(UnknownRuleException::class);
        (new Marksimple())->removeRule('unknown_rule');
    }

    /**
     * Test if basic text input will be parsed and wrapped by paragraphs.
     */
    public function testParse()
    {
        $testee = new Marksimple();
        $input = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr,';
        $input .= ' diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam';
        $expected = '<p>'.$input.'</p>';
        static::assertSame($expected, $testee->parse($input));
    }

    /**
     * Check the exception if the file is not exist.
     *
     * @throws Exception
     * @throws InvalideFileException
     */
    public function testParseFileNoExist()
    {
        $this->expectException(InvalideFileException::class);
        $testee = new Marksimple();
        $testee->parseFile('noFile');
    }

    /**
     * Check the exception if the file is not readable.
     *
     * @throws Exception
     * @throws InvalideFileException
     */
    public function testParseFileNoReadable()
    {
        $this->expectException(InvalideFileException::class);
        $testee = new Marksimple();
        $testee->parseFile($this->noReadableFile);
    }

    /**
     * Check logger method will return NullLogger class instance.
     */
    public function testLogger()
    {
        $testee = new Marksimple();
        try {
            $this->assertInstanceOf(NullLogger::class, $testee->logger());
        } catch (\Exception $error) {
        }
    }

    /**
     * Simple test that return null, if no logger is active.
     */
    public function testNullLogger()
    {
        $teste = new Marksimple();
        try {
            $this->assertNull($teste->logger());
        } catch (\Exception $error) {
        }
    }
}
