<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple;

use Bueltge\Marksimple\Rule\ElementRuleInterface;

class Marksimple
{

    /**
     * Define the default rules.
     *
     * @var array
     */
    public $defaultRules = [
        'header' => Rule\Header::class,
        'link' => Rule\Link::class,
        'strong' => Rule\Strong::class,
        'italic' => Rule\Italic::class,
        'ul' => Rule\UnorderedList::class,
        'code' => Rule\Code::class,
        'pre' => Rule\Pre::class,
        'precleanup' => Rule\PreCleanup::class,
        'listcleanuo' => Rule\ListCleanup::class,
        'hr' => Rule\HorizontalLine::class,
        'br' => Rule\NewLine::class,
    ];

    /**
     * Store the Markdown content that we should render.
     *
     * @var string
     */
    public $content;
    /**
     * Store the tags that we parse and render to html.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Store the strings, there we exclude on set paragraph.
     *
     * @var array
     */
    public $paragraphExcludes = [
        '<', // HTML.
        '    ', // Code.
        "\t", // Tab.
    ];

    /**
     * Marksimple constructor.
     *
     * @param string $content The Markdown content that we should render.
     */
    public function __construct(string $content = '')
    {
        $this->content = $content;
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
     * @param string $name
     * @param ElementRuleInterface $rule
     */
    public function addRule(string $name, ElementRuleInterface $rule)
    {
        $this->rules[$name] = $rule;
    }

    /**
     * Allows this class to decide how it will react.
     *
     * @return string The content that we should render.
     */
    public function __toString()
    {

        $this->setErrorReporting();

        return $this->parse($this->content);
    }

    /**
     * Active Error Reporting.
     *
     * @param bool $status Active the visible error reporting.
     *
     * @return bool Get true, if error reporting is active.
     */
    protected function setErrorReporting(bool $status = false): bool
    {

        if (!$status) {
            return false;
        }

        ini_set('display_errors', 'On');
        error_reporting(E_ALL);

        return true;
    }

    /**
     * Parse the markdown content and check for each rule.
     *
     * @param string $content
     * @return string
     */
    public function parse(string $content): string
    {

        if (file_exists($content) && is_readable($content)) {
            $content = $this->getContent($content);
        }

        $content = $this->sanitize($content);

        $html = array_reduce(
            $this->rules,
            function (string $content, ElementRuleInterface $rule): string {
                return preg_replace_callback($rule->rule(), [$rule, 'render'], $content);
            },
            $content
        );

        return $this->addParagraph($html);
    }

    /**
     * Parse content from a markdown file.
     *
     * @param string $file The path to the file that we parse.
     *
     * @return string
     */
    public function getContent(string $file): string
    {

        return file_get_contents($file, true);
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
        $content = htmlentities($content, ENT_QUOTES, 'UTF-8');

        return $content;
    }

    /**
     * Remove rules, if is not necessary.
     *
     * @param string $name
     * @return bool
     */
    public function removeRule(string $name): bool
    {
        if (!isset($this->rules[$name])) {
            throw new \InvalidArgumentException('Missing Rule name: ' . $name);
        }

        unset($this->rules[$name]);
        return true;
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
        $content = explode("\n", $content);
        $p_content = '';
        foreach ($content as $line) {
            if (!$this->strposa($line, $this->paragraphExcludes)) {
                $line = sprintf('<p>%s</p>', trim($line));
            }
            $p_content .= "\n" . $line;
        }
        return $p_content;
    }

    /**
     * Find the position of the first occurrence of a substring in a string.
     * Get only true, if is on the first position (0).
     *
     * @param string $haystack The string to search in.
     * @param array $needle An array with strings for search.
     * @param int $offset If specified, search will start this number of characters counted from the beginning of
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
     * Helps to print the content include markup and line breaks.
     *
     * @param string $content
     * @return string
     */
    public function debug(string $content): string
    {
        return '<pre>' . json_encode($content) . '</pre>';
    }
}
