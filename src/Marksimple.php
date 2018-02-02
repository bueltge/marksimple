<?php declare(strict_types=1); # -*- coding: utf-8 -*-

namespace Bueltge\Marksimple;

use Bueltge\Marksimple\Exception\UnknownRuleException;
use Bueltge\Marksimple\Rule\ElementRuleInterface;

class Marksimple
{

    /**
     * Define the default rules.
     *
     * @var array
     */
    protected $defaultRules = [
        'header'      => Rule\Header::class,
        'image'       => Rule\Image::class,
        'link'        => Rule\Link::class,
        'strong'      => Rule\Strong::class,
        'italic'      => Rule\Italic::class,
        'ul'          => Rule\UnorderedList::class,
        'pre'         => Rule\Pre::class,
        'githubpre'   => Rule\GithubPre::class,
        'precleanup'  => Rule\PreCleanup::class,
        'code'        => Rule\Code::class,
        'listcleanup' => Rule\ListCleanup::class,
        'hr'          => Rule\HorizontalLine::class,
        'br'          => Rule\NewLine::class,
    ];

    /**
     * Store the strings, there we exclude on set paragraph.
     *
     * @var array
     */
    protected $paragraphExcludes = [
        '<', // HTML.
        '    ', // Code.
        "\t", // Tab.
        '---', // hr
    ];

    /**
     * Store the tags that we parse and render to html.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Marksimple constructor.
     */
    public function __construct()
    {

        $this->initDefaultRules();
    }

    /**
     * Add default rules.
     */
    protected function initDefaultRules()
    {

        foreach ($this->defaultRules as $name => $class) {
            $this->addRule($name, new $class);
        }
    }

    /**
     * Add rule to parse content with an regex string.
     *
     * @param string               $name
     * @param ElementRuleInterface $rule
     */
    public function addRule(string $name, ElementRuleInterface $rule)
    {

        $this->rules[ $name ] = $rule;
    }

    /**
     * @param string $name
     *
     * @throws UnknownRuleException
     *
     * @return bool
     */
    public function removeRule(string $name): bool
    {
        if (!$this->hasRule($name)) {
            throw new UnknownRuleException(
                sprintf(
                    'No rule found for the given name "%s".',
                    $name
                )
            );
        }

        unset($this->rules[ $name ]);

        return true;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasRule(string $name): bool
    {
        return isset($this->rules[ $name ]);
    }

    /**
     * Get the markdown formatted content.
     *
     * @param string $content
     *
     * @return string
     */
    public function parse(string $content): string
    {

        $html = array_reduce(
            $this->rules,
            function (string $content, ElementRuleInterface $rule): string {

                return preg_replace_callback($rule->rule(), [$rule, 'render'], $content);
            },
            $this->sanitize($content)
        );

        return $this->addParagraph($html);
    }

    /**
     * Filter the content for not necessary strings.
     *
     * @param string $content The content from the Markdown file.
     *
     * @return string
     */
    protected function sanitize(string $content): string
    {

        // Add new line to get the first character of a string.
        $content = "\n" . $content;

        // Standardize line breaks.
        $content = str_replace(["\n\n", "\r\n", "\r"], "\n", $content);

        // Remove surrounding line breaks.
        $content = trim($content, "\n");

        // Filter html.
        $content = htmlentities($content, ENT_NOQUOTES, 'UTF-8');

        return $content;
    }

    /**
     * Add p tag for each paragraph, exclude different content types.
     *
     * @param string $content The parsed content in html format.
     *
     * @return string
     */
    public function addParagraph(string $content): string
    {

        // Split for each line to exclude.
        $content  = explode("\n", $content);
        $pContent = '';
        foreach ($content as $line) {
            if (!$this->strposa($line, $this->paragraphExcludes)) {
                $line = sprintf('<p>%s</p>', trim($line));
            }
            $pContent .= $line;
        }

        return $pContent;
    }

    /**
     * Find the position of the first occurrence of a substring in a string.
     * Get only true, if is on the first position (0).
     *
     * @param string $haystack The string to search in.
     * @param array  $needle   An array with strings for search.
     * @param int    $offset   If specified, search will start this number of characters counted from the beginning of
     *                         the string.
     *
     * @return bool
     */
    protected function strposa(string $haystack, array $needle, int $offset = 0): bool
    {

        foreach ($needle as $query) {
            // If we found the string only on position 0.
            if (strpos($haystack, $query, $offset) === 0) {
                return true;
            } // stop on first false result
        }

        return false;
    }

    /**
     * Remove all rules, reset the variable that store the rules.
     *
     * @return bool
     */
    public function removeAllRules(): bool
    {
        $this->rules = [];

        return true;
    }
}
