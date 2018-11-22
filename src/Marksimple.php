<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

namespace Bueltge\Marksimple;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Bueltge\Marksimple\Exception\InvalideFileException;
use Bueltge\Marksimple\Exception\UnknownRuleException;
use Bueltge\Marksimple\Rule\ElementRuleInterface;

class Marksimple
{
    /**
     * logger class
     *
     * @var LoggerInterface
     */
    private $logger;

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
        'cleanuplist' => Rule\CleanUpList::class,
        'pre' => Rule\Pre::class,
        'cleanuppre' => Rule\CleanUpPre::class,
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
     * Marksimple constructor.
     */
    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger ?? new NullLogger();

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
     * Parse content from a markdown file.
     *
     * @param string $file The path to the file that we parse.
     *
     * @return string
     * @throws InvalideFileException
     */
    public function parseFile(string $file): string
    {
        if (!is_file($file)) {
            throw new InvalideFileException(
                sprintf('File "%s" does not exist.', $file)
            );
        }

        if (!is_readable($file)) {
            throw new InvalideFileException(
                sprintf('File "%s" cannot be read.', $file)
            );
        }

        return $this->parse((string) file_get_contents($file, true));
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
        return array_reduce(
            $this->rules,
            function (string $content, ElementRuleInterface $rule): string {
                return $rule->parse($content);
            },
            $this->sanitize($content)
        );
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
        $content = "\n".$content;

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

    /**
     * Get the logger class instance
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}
