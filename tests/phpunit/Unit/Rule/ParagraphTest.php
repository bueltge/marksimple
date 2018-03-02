<?php # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple\Tests\Unit\Rule;

use Bueltge\Marksimple\Rule;
use Bueltge\Marksimple\Rule\ElementRuleInterface;
use Bueltge\Marksimple\Tests\Unit\AbstractRuleTestCase;

class ParagraphTest extends AbstractRuleTestCase
{

    public function provideList(): array
    {
        return [
            'normal paragraph' => [
                'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor.',
                '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor.</p>'
            ]
        ];
    }

    protected function testee(): ElementRuleInterface
    {
        return new Rule\Paragraph();
    }


    public function testNoMarkdownContent()
    {
        static::markTestSkipped('Paragraphes are always added as wrap arround default content.');
    }
}
