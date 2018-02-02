<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class GithubPre implements ElementRuleInterface
{

    /**
     * Get the regex rule to identify the content for the callback.
     * Code blocks via 3 ` include language string (optional).
     *
     * @return string
     */
    public function rule(): string
    {
        return '#(^|\n)([`~]{3,})(?: *\.?([a-zA-Z0-9\-.]+))?\n+([\s\S]+?)\n+\2(\n|$)#';
    }

    /**
     * Render the content and get content include markup.
     *
     * @param array $content
     * @return string
     */
    public function render(array $content): string
    {
        // Define css class for each language.
        $language = !empty($content[ 3 ]) ? filter_var($content[ 3 ], FILTER_SANITIZE_STRING) : '';
        $class    = !empty($language) ? sprintf(' class="%s language-%s"', $language, $language) : '';
        // Build one block so that we not create each paragraph.
        $content = str_replace("\n", '<br>', $content[ 4 ]);

        return sprintf('<pre><code%s>%s</code></pre>', $class, $content);
    }
}
