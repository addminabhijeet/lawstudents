# Testing Phase Report - 2026-09-30

Scope: verify the Laravel project without changing existing application code, test code, migrations, routes, models, controllers, package manifests, or business logic.

## Result

The project does not currently pass all testing phases under a clean isolated test run.

The repeatable runner is `tests/run-phases.ps1`. It runs Composer validation, PHP platform checks with GD loaded for that process only, a frontend production build into ignored storage, and PHPUnit with an in-memory SQLite test database. It writes all generated logs under `storage/framework/testing/`.

## Verified Phases

| Phase | Command / Evidence | Result |
| --- | --- | --- |
| PHP syntax | 244 PHP files parsed | Pass |
| Composer manifest | `composer validate --no-check-publish` | Pass |
| Composer platform | `php -d extension=gd composer.phar check-platform-reqs` | Pass |
| Frontend dependencies | `npm ls --depth=0` | Pass |
| Frontend production build | `npm run build -- --outDir storage/framework/testing/frontend-build-audit-20260930` | Pass |
| Laravel route boot | `php artisan route:list --except-vendor --json` | Pass, 291 application routes |
| PHPUnit | isolated `APP_ENV=testing`, SQLite `:memory:` | Fail: 37 tests, 102 assertions, 19 errors, 1 failure |
| Dependency audit | `composer audit --format=json`, `npm audit --json` | Fail: Composer and npm advisories present |

## PHPUnit Blockers

1. Fresh test database migrations fail because `database/migrations/2025_09_29_000003_add_missing_columns_to_payments_table.php` alters the `payments` table before the migration that creates that table. This causes 19 API tests using `RefreshDatabase` to error before their assertions run.

2. `Tests\Feature\ExampleTest::test_the_application_returns_a_successful_response` expects `/` to return HTTP 200, but the isolated test run returns an error response instead.

3. Real HTTP probes against API routes found blockers that remain after the migration order issue is addressed:
   - `GET /api/v1/courses/search?q=ab` returns 500 with `Cannot access protected property App\Exceptions\InvalidSearchException::$code` from `app/Http/Controllers/Api/V1/CourseController.php`.
   - `GET /api/v1/payments/history` returns 500 with `Auth guard [sanctum] is not defined` from the route middleware.

## Dependency Audit Blockers

Composer audit found 52 advisories across these packages: `dompdf/dompdf`, `guzzlehttp/guzzle`, `guzzlehttp/psr7`, `laravel/framework`, `league/commonmark`, `league/flysystem`, `phpseclib/phpseclib`, `setasign/fpdi`, `symfony/http-foundation`, `symfony/http-kernel`, `symfony/mailer`, `symfony/mime`, `symfony/polyfill-intl-idn`, `symfony/routing`, and `symfony/yaml`.

npm audit found 11 vulnerabilities: 1 critical, 9 high, and 1 moderate.

Raw audit output is stored in `storage/framework/testing/dependency-audit-20260930/`.

## Files Added

- `tests/run-phases.ps1`
- `storage/docs/reports/TESTING_PHASE_REPORT_2026_09_30.md`

No existing tracked application, configuration, migration, route, model, controller, or test file was changed.
