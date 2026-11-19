# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

(This document follows the strucutre described in http://keepachangelog.com/)

## Unreleased

### Changed
* Lower `phpunit/phpunit` to `^11.5`: PHPUnit 13 requires PHP 8.4, but the library and CI support PHP 8.2 and 8.3. Refresh `composer.lock`.
* Set `minimum-stability` to `stable` and remove unused `allow-plugins` entries.
* CI: remove the duplicate `phpcbf.yml` autofix workflow (autofix stays in `main.yml` for pull requests), set default `contents: read` permissions, drop the redundant non-blocking `phpcs` step and `composer clear-cache`, and cache Composer packages.
* Update `antecedent/patchwork` to 2.2.5 and `stefanzweifel/git-auto-commit-action` to 7.

## 2.3.0 (2026-11-06)

Clean up version and some improvements of tests.

* Replace invalid UTF-8 during sanitization.
* Handle `parseFile` read failures.
* Fix link destination XSS and its regression assertion.
* Add malicious-input security regression tests.
* Clean up deprecated PHP and tooling APIs.
* Change `paragraphExcludes` to use string array type.
* Normalize the indentation in `composer.json` to the repository's four-space style.
* Update `phpunit/phpunit` requirement from `^9.0 || ^12.5.22` to `^13.4.5`.

## 2.2.0 (2022-05-17)

* Update dependencies, thanks to [@Kaishiyoku](https://github.com/Kaishiyoku).
* Update `composer.json`.

## 2.1.0 (2018-12-12) - Include Logging option

* Add [psr/log](https://github.com/php-fig/log) feature.
* Use log inside the `parseFile` method to have the chance to log problems with files.

## 2.0.0 (2018-09-16) - Solid

The rules and unit tests for the rules are now more solid and stable. Also it should be easier to enhance rules and tests.

* Add new possibilities for markdown syntax.
* Maintain new refactor in context of rules.
* Maintain unit tests about all methods, rules.

## 1.0.0 (2018-01-26) - Discover

The first usable release, simple short one file to include and parse the Markdown syntax.

