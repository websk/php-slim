# Changelog

All notable changes to this project are documented in this file.

## [2.4.0] - 2026-10-05

### Changed

- Added support for PHP 8.5.11 while retaining PHP 8.3 as the minimum supported version.
- Updated Slim to 4.15 and Slim PSR-7 to 1.8.
- Scoped Composer PSR-4 autoloading to the `WebSK\` namespace.
- Changed facade container access to use the PSR-11 `get()` method.
- Added explicit `mixed` types and array value type declarations.

### Fixed

- Added a clear `LogicException` when a facade is used without a configured container.
- Explicitly converted request URI objects to strings in `BaseHandler::getRequestUri()`.

### Added

- Added PHPUnit 12.5 coverage for redirects, requests, responses, facades, routing, and handlers.
- Added PHPStan level 6 analysis without a baseline.
- Added Composer scripts for linting, tests, static analysis, and the complete check suite.
- Added the MIT license.
