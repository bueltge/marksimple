# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

(This document follows the strucutre described in http://keepachangelog.com/)

## Unreleased

### Changed
* Lower `phpunit/phpunit` to `^11.5`: PHPUnit 13 requires PHP 8.4, but the library and CI support PHP 8.2 and 8.3. Refresh `composer.lock`.
* Set `minimum-stability` to `stable` and remove unused `allow-plugins` entries.
* Update dependencies: `antecedent/patchwork` 2.2.5, `stefanzweifel/git-auto-commit-action` 7.

## 2.3.0 (2026-11-06)

### Security
* Fix XSS via link destinations and add malicious-input regression tests.

### Fixed
* Replace invalid UTF-8 during sanitization.
* Handle file read failures in `parseFile`.

### Changed
* Require PHP `^8.2`; add return type declarations and clean up deprecations.
* Add PHP 8.4 and 8.5 to the CI matrix; add automatic PHPCBF code style fixes and a workflow to update `composer.lock`.
* Update to `inpsyde/php-coding-standards` ^2.0 and PHPUnit ^13.4.

## 2.2.0 (2022-05-17)

* Raise minimum PHP version to 7.4 and add PHP 8.x to the test matrix.
* Update dependencies (PHPUnit 9, `psr/log`, `antecedent/patchwork`, coding standards).

## 2.1.0 (2018-12-12)

* Add `psr/log` support: `Marksimple` accepts a logger (default `NullLogger`) and logs `parseFile` exceptions.
* Add unit tests for `getLogger`, `parseFile` and `removeAllRules`.
* Add code coverage (Scrutinizer, Codecov) and PHPDoc annotations.

## 2.0.0 (2018-09-15)

* Add new possibilities for markdown syntax.
* Maintain new refactor in context of rules.
* Maintain unit tests about all methods, rules.

## 1.0.0 (2017-09-02)

 * First public version.

