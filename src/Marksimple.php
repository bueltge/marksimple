<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple;

use Bueltge\Marksimple\Rule\ElementRuleInterface;

class Marksimple
{

    /**
     * Store the tags that we parse and render to html.
     *
     * @var array
     */
    protected $rules = [];

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
        'paragraph' => Rule\Paragraph::class,
    ];

    /**
     * Store the Markdown content that we should render.
     *
     * @var string
     */
    public $content;

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
     * Add default rules.
     */
    private function initDefaultRules()
    {
        foreach ($this->defaultRules as $name => $class) {
            $this->addRule($name, new $class);
        }
    }

    /**
     * Filter the content for not necessary strings.
     *
     * @param string $content The content from the Markdown file.
     *
     * @return string
     */
    private function sanitize(string $content): string
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

        return $html;
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
