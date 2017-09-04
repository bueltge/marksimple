<?php # -*- coding: utf-8 -*-
declare( strict_types = 1 );

/**
 * A simple MarkDown parser, short and only with the rules there I currently need.
 *  The function is regex based and it is possible to enhance your custom rules.
 * Kudos to lof of Stack Overflow answers for the regex part.
 * Also Kudos to the Regex tester https://regex101.com and https://www.debuggex.com/
 *
 * @since   2017-08-24
 * @version 2017-08-24
 */

namespace Bueltge\MarkSimple;

/**
 * Class MarkSimple
 *
 * @package Bueltge\MarkSimple
 */
class MarkSimple {

	/**
	 * Store the tags that we parse and render to html.
	 *
	 * @var array
	 */
	public $rules = [
		// Header h1 - h6.
		'#^(\#{1,6})\s*([^\#]+?)\s*\#*$#m'                                      => 'self::get_header',
		// Links without possibility to add javascript, XSS topic.
		'#\[([^\[]+)\]\((?:javascript:)?([^\)]+)\)(?!`)#'                       => '<a href=\'\2\'>\1</a>',
		// Strong, bold via double star ** or double underline __.
		'#(?<!\\\)([*_]{2})([^\n]+?)\1#'                                        => '<strong>\2</strong>',
		// Italic formatting via one star * or one underline _.
		'#(?<!\\\)([*_])([^\n|`]+?)\1#'                                           => '<em>\2</em>',
		// ul List via star *.
		'#^ *[*\-+] +(.*?)$#m'                                                  => 'self::get_ul_list',
		// Inline Code via `.
		'#(?<!\\\)`([^\n]+?)`#'                                                 => 'self::get_inline_code',
		// @ToDo - necessary?
		'#(^|\n)([`~]{3,})(?: *\.?([a-zA-Z0-9\-.]+))?\n+([\s\S]+?)\n+\2(\n|$)#' => 'self::get_fenced_code_block',
		// Code blocks via 4 spaces or tab.
		'#^(?:\0(.*?)\0\n)?( {4}|\t)(.*?)$#m'                                   => 'self::get_code_block',
		// Clean up code blocks to leave only one open/close pre for each block.
		'#<\/code><\/pre>\n<pre><code(>| .*?>)#'                                => "\n",
		// Clean up ol|ul li blocks to leave only start/end ul with li.
		'#\s*<\/(ol|ul)>\n<\1>\s*#'                                             => "\n",
		// Horizontal line via ---.
		'#\n-{3,}#'                                                             => "\n<hr>",
		// Leave br as new line helper.
		'#&lt;br&gt;#'                                                        => "\n<br>",
	];

	/**
	 * Store the strings, there we exclude on set paragraph.
	 *
	 * @var array
	 */
	public $paragraph_excludes = [
		'<', // HTML.
		'    ', // Code.
		"\t", // Tab.
	];
	/**
	 * Store the MarkDown content that we should render.
	 *
	 * @var string
	 */
	public $content;

	/**
	 * MarkSimple constructor.
	 *
	 * @param string $content The MarkDown content that we should render.
	 */
	public function __construct( string $content ) {

		$this->content = $content;
	}

	/**
	 * Allows this class to decide how it will react.
	 *
	 * @return string The content that we should render.
	 */
	public function __toString() {

		$this->set_error_reporting();

		return $this->render( $this->content );
	}

	/**
	 * Convert Header syntax include the different level to html.
	 *
	 * @param array $content Content to search for header syntax.
	 *
	 * @return string
	 */
	private function get_header( array $content ) : string {

		list( $temp, $char, $header ) = $content;
		$heading_level = strlen( $char );

		return sprintf( '<h%d>%s</h%d>', $heading_level, trim( $header ), $heading_level );
	}

	/**
	 * Add p tag for each paragraph, exclude different content types.
	 *
	 * @param string $content The parsed content in html format.
	 *
	 * @return string
	 */
	private function get_paragraph( string $content ) : string {

		// Split for each line to exclude.
		$content   = explode( "\n", $content );
		$p_content = '';
		foreach ( $content as $line ) {
			if ( ! $this->strposa( $line, $this->paragraph_excludes ) ) {
				$line = sprintf( '<p>%s</p>', trim( $line ) );
			}

			$p_content .= "\n" . $line;
		}

		return $p_content;
	}

	/**
	 * Replace Markdown inline code string with html.
	 *
	 * @param array $content The parsed content in markdown format.
	 *
	 * @return string
	 */
	private function get_inline_code( array $content ) : string {

		return sprintf( '<code>%s</code>', $content[1] );
	}

	/**
	 * Get fenced code blocks.
	 *
	 * @param array $content The parsed content in markdown format.
	 *
	 * @return string
	 */
	private function get_fenced_code_block( array $content ) : string {

		return sprintf( '%s', $content[1] );
	}

	/**
	 * Convert code block with 4 spaces to pre block.
	 *
	 * @param array $content The parsed content in markdown format.
	 *
	 * @return string
	 */
	private function get_code_block( array $content ) : string {

		return sprintf( '<pre><code>%s</code></pre>', $content[2] . $content[3] );
	}

	/**
	 * Convert unordered list markdown syntax * html ul li.
	 *
	 * @param array $content The parsed content in markdown format.
	 *
	 * @return string
	 */
	private function get_ul_list( array $content ) : string {

		return sprintf( '<ul><li>%s</li></ul>', trim( $content[1] ) );
	}

	/**
	 * Get the chance to add custom rules, add filter (regex) and replacement (html) to the rule-array.
	 *
	 * @param string $filter The regex rule.
	 * @param string $html   The replacement content, typically html.
	 */
	public function apply_rules( string $filter, string $html ) {

		$this->rules[ $filter ] = $html;
	}

	/**
	 * Parse content from a markdown file.
	 *
	 * @param string $file The path to the file that we parse.
	 *
	 * @return string
	 */
	private function get_content( string $file ) : string {

		return file_get_contents( $file, true );
	}

	/**
	 * Filter the content for not necessary strings.
	 *
	 * @param string $content The content from the MarkDown file.
	 *
	 * @return string
	 */
	private function sanitize( string $content ) : string {

		// Add new line to get the first character of a string.
		$content = "\n" . $content;

		// Standardize line breaks.
		$content = str_replace( array( "\n\n", "\r\n", "\r" ), "\n", $content );

		// Remove surrounding line breaks.
		$content = trim( $content, "\n" );
		// Filter html.
		$content = htmlentities( $content, ENT_QUOTES, 'UTF-8' );

		return $content;
	}

	/**
	 * Render the MarkDown in html.
	 *
	 * @param string $content The content in markdown format.
	 *
	 * @return string
	 */
	public function render( string $content = '' ) : string {

		// Check for file, not string.
		if ( file_exists( $content ) && is_readable( $content ) ) {
			$content = $this->get_content( $content );
		}

		$content = $this->sanitize( $content );

		foreach ( $this->rules as $search => $html ) {

			if ( is_callable( $html ) ) {
				$content = preg_replace_callback( $search, $html, $content );
			} else {
				$content = preg_replace( $search, $html, $content );
			}
		}

		$content = $this->get_paragraph( $content );

		return rtrim( $content );
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
	private function strposa( string $haystack, array $needle, int $offset = 0 ) : bool {

		foreach ( $needle as $query ) {
			// If we found the string only on position 0.
			if ( strpos( $haystack, $query, $offset ) === 0 ) {
				return true;
			} // stop on first false result
		}

		return false;
	}

	/**
	 * Active Error Reporting.
	 *
	 * @param bool $status Active the visible error reporting.
	 *
	 * @return bool Get true, if error reporting is active.
	 */
	protected function set_error_reporting( bool $status = false ) : bool {

		if ( ! $status ) {
			return false;
		}

		ini_set( 'display_errors', 'On' );
		error_reporting( E_ALL );

		return true;
	}
}
