<?php

declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class GithubPre extends AbstractRegexRule
{
    /**
     * Get the regex rule to identify the fromFile for the callback.
     * Code blocks via 3 ` include language string (optional).
     *
     * @return string
     */
    public function rule(): string
    {
        return '#(^|\n)([`~]{3,})(?: *\.?([a-zA-Z0-9\-.]+))?\n+([\s\S]+?)\n+\2(\n|$)#';
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $content): string
    {
        // Define css class for each language.
        $language = !empty($content[3]) ? filter_var($content[3], FILTER_SANITIZE_STRING) : '';
        $class = !empty($language) ? sprintf(' class="%s language-%s"', $language, $language) : '';
        // Build one block so that we not create each paragraph.
        $content = str_replace("\n", '<br>', $content[4]);

        return sprintf('<pre><code%s>%s</code></pre>', $class, $content);
    }
}
