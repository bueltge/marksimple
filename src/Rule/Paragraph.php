<?php

declare(strict_types=1);

namespace Bueltge\Marksimple\Rule;

class Paragraph implements ElementRuleInterface
{
    /**
     * Store the strings, there we exclude on set paragraph.
     *
     * @var array
     */
    protected static $paragraphExcludes = [
        '<', // HTML.
        '    ', // Code.
        "\t", // Tab.
        '---', // hr
    ];

    /**
     * {@inheritdoc}
     */
    public function parse(string $content): string
    {
        // Split for each line to exclude.
        $content = explode("\n", $content);
        $pContent = '';
        foreach ($content as $line) {
            if (!$this->strposa($line, self::$paragraphExcludes)) {
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
     * @param int    $offset   If specified, search will start this number of characters counted
     *                         from the beginning of the string.
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
}
