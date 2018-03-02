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
        'header' => Rule\Header::class,
        'image' => Rule\Image::class,
        'link' => Rule\Link::class,
        'strong' => Rule\Strong::class,
        'italic' => Rule\Italic::class,
        'ul' => Rule\UnorderedList::class,
        'pre' => Rule\Pre::class,
        'githubpre' => Rule\GithubPre::class,
        'code' => Rule\Code::class,
        'hr' => Rule\HorizontalLine::class,
        'br' => Rule\NewLine::class,
        'p' => Rule\Paragraph::class,
    ];

    /**
     * Store the tags that we parse and render to html.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Store the MarkDown content that we should render.
     *
     * @var string
     */
    protected $content;

    /**
     * Marksimple constructor.
     * @param string $content The content that we should render.
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
    public function __toString(): string
    {
        return $this->parse($this->content);
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
        // Check for file, not string.
        if (file_exists($content) && is_readable($content)) {
            $content = $this->content($content);
        }

        return array_reduce(
            $this->rules,
            function (string $content, ElementRuleInterface $rule): string {

                return $rule->parse($content);
            },
            $this->sanitize($content)
        );
    }

    /**
     * Parse content from a markdown file.
     *
     * @param string $file The path to the file that we parse.
     *
     * @return string
     */
    protected function content(string $file): string
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
        $content = htmlentities($content, ENT_NOQUOTES, 'UTF-8');

        return $content;
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

        unset($this->rules[$name]);

        return true;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasRule(string $name): bool
    {
        return isset($this->rules[$name]);
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
