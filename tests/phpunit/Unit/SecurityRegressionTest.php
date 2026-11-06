<?php

declare(strict_types=1);

namespace Bueltge\Marksimple\Tests\Unit;

use Bueltge\Marksimple\Marksimple;

/**
 * Security regression tests for untrusted Markdown input.
 */
class SecurityRegressionTest extends AbstractTestCase
{
    /**
     * Verify raw HTML is escaped in text and supported Markdown elements.
     */
    public function testRawHtmlIsEscapedInTextAndMarkdownElements(): void
    {
        $testee = new Marksimple();
        $inputs = [
            'text' => '<script>alert(1)</script>',
            'header' => '# <script>alert(1)</script>',
            'list' => '- <script>alert(1)</script>',
            'code' => '`<script>alert(1)</script>`',
            'pre' => '    <script>alert(1)</script>',
        ];

        foreach ($inputs as $context => $input) {
            $output = $testee->parse($input);

            static::assertStringNotContainsString('<script', $output, $context);
            static::assertStringContainsString(
                '&lt;script&gt;',
                $output,
                $context
            );
        }
    }

    /**
     * Verify JavaScript link destinations are rejected.
     */
    public function testJavascriptLinkIsRejected(): void
    {
        $output = (new Marksimple())->parse('[click](javascript:alert(1))');
        static::assertStringNotContainsString('href="javascript:', $output);
    }

    /**
     * Verify data URI link destinations are rejected.
     */
    public function testDataLinkIsRejected(): void
    {
        $output = (new Marksimple())->parse('[click](data:text/html,example)');
        static::assertStringNotContainsString('href="data:', $output);
    }

    /**
     * Verify quotes in link URLs cannot inject HTML attributes.
     */
    public function testLinkAttributeInjectionIsEscaped(): void
    {
        $output = (new Marksimple())->parse(
            '[click](https://example.test/" onmouseover="alert(1))'
        );

        $document = new \DOMDocument();
        $document->loadHTML($output, LIBXML_NONET);

        $link = $document->getElementsByTagName('a')->item(0);
        static::assertNotNull($link);
        static::assertSame(
            'https://example.test/" onmouseover="alert(1',
            $link->getAttribute('href')
        );
        static::assertFalse($link->hasAttribute('onmouseover'));
    }

    /**
     * Verify quotes in image URLs cannot inject HTML attributes.
     */
    public function testImageUrlAttributeInjectionIsEscaped(): void
    {
        $this->markTestIncomplete(
            'Known security gap: a hostile image URL can inject an HTML attribute.'
        );

        $output = (new Marksimple())->parse(
            '![image](https://example.test/image.png" onerror="alert(1))'
        );
        static::assertStringNotContainsString('onerror=', $output);
    }

    /**
     * Verify JavaScript image URLs are rejected.
     */
    public function testImageJavascriptUrlIsRejected(): void
    {
        $this->markTestIncomplete(
            'Known security gap: image URLs are not validated against executable schemes.'
        );

        $output = (new Marksimple())->parse('![image](javascript:alert(1))');
        static::assertStringNotContainsString('src="javascript:', $output);
    }

    /**
     * Verify image alt text cannot inject HTML attributes.
     */
    public function testImageAltAttributeInjectionIsEscaped(): void
    {
        $this->markTestIncomplete(
            'Known security gap: hostile image title text is not consistently HTML-escaped.'
        );

        $output = (new Marksimple())->parse('![image](path "alt" onerror="alert(1)")');
        static::assertStringNotContainsString('onerror=', $output);
    }

    /**
     * Verify script markup in image alt text is escaped.
     */
    public function testImageAltScriptIsEscaped(): void
    {
        $this->markTestIncomplete(
            'Known security gap: script content in image title text is not consistently escaped.'
        );

        $output = (new Marksimple())->parse('![image](path "<script>alert(1)</script>")');
        static::assertStringNotContainsString('<script', $output);
    }

    /**
     * Verify CRLF and CR line endings are normalized to LF.
     */
    public function testCrLfAndCrLineEndingsAreNormalized(): void
    {
        $testee = new Marksimple();
        $expected = $testee->parse("first\nsecond");

        static::assertSame($expected, $testee->parse("first\r\nsecond"));
        static::assertSame($expected, $testee->parse("first\rsecond"));
    }
}
