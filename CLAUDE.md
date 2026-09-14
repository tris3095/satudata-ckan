# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A Laravel 12 (PHP 8.2) public data portal for Sumatera Selatan province ("Satu Data" / open data portal) backed by **CKAN** as the system of record for datasets. Laravel does not store datasets itself — it's a front-end/admin layer over CKAN's Action API, plus several other government API integrations, and an admin CMS for publications (news, infographics, statistics releases, webinars, surveys).

## Commands

Composer scripts (see `composer.json`):

```bash
composer install
npm install

# Run app + queue worker + log tailer + vite, all at once
composer dev

# Tests (clears config cache first)
composer test
# equivalent to:
php artisan test
php artisan test --filter=TestName        # single test
php artisan test tests/Unit/DataMaskingServiceTest.php   # single file

# Frontend build
npm run dev      # vite dev server
npm run build     # production build

# Linting
vendor/bin/pint          # Laravel Pint (PHP code style)
vendor/bin/pint --dirty  # only changed files
```

Test env uses in-memory SQLite (`phpunit.xml`); the real app uses MySQL (`DB_CONNECTION=mysql`, see `.env`).

## Architecture

### CKAN integration is the core dependency

`App\Services\CkanService` (`app/Services/CkanService.php`) wraps the CKAN Action API (`/api/3/action/...`) — `package_list`, `package_show`, `package_search`, `organization_list`, `group_list`, etc. `CKAN_URL`/`CKAN_API_KEY` (`config/ckan.php`) point at the real CKAN instance (`https://opendata.sumselprov.go.id/` in `.env`). There is no local `Dataset`/`Organization`/`Group` model — dataset, organization, and group listing/detail/search/pagination all flow through this service into `DatasetController`, `InstantionController` (organizations), and `HomeController` (groups). Pagination against CKAN is done manually (`start`/`rows` params, then wrapped in `LengthAwarePaginator`) since CKAN doesn't return a Laravel-style paginator.

### Other external integrations, each behind its own Service class

- `EsakipService` — pulls government accountability documents from an external ESAKIP API (`config/esakip.php`, `ESAKIP_API_URL`/`ESAKIP_API_TOKEN`), used by `HomeController::esakipDocuments`.
- `GeoportalService` — pulls geospatial records from `geoportal.sumselprov.go.id` (hardcoded base URLs, not env-configured).
- `SumselNewsService` — pulls provincial news from `sumselprov.go.id`'s public API via raw `file_get_contents` (SSL verification disabled), not the `Http` facade.

All of these fail soft: on HTTP error or exception they return an `['error' => true, 'message' => ...]` array rather than throwing, so callers must check for that shape rather than relying on exceptions.

### Data masking

`App\Services\DataMaskingService` (config in `config/masking.php`) masks PII (NIK, email, phone, name, address) in text, CSV, JSON, and arrays, using both explicit column/key names and regex pattern detection. It's used when streaming CKAN resource downloads to the public (`DatasetController::download` → `maskFileFromUrl`), so masking is applied to *downloaded remote files*, not to data already in the local DB. A `mask_pribadi()` global helper (`app/Helpers/helpers.php`, autoloaded via `composer.json`'s `autoload.files`) exposes this to Blade views for ad-hoc masking. Toggle globally with `DATA_MASKING_ENABLED`.

### Two route files, two auth models

- `routes/web.php` — public site (home, datasets, organizations/"instansi", groups, publications, surveys, "tentang"/about). Wrapped in `CountVisitorByIP` middleware for visitor analytics (`Visitor` model).
- `routes/admin.php` — `/auth/*` login and `/admin/*` CMS, both registered in `bootstrap/app.php`. Admin routes use custom middleware (`app/Http/middleware/`, note the lowercase `middleware` folder — non-standard Laravel casing) rather than Breeze/Fortify:
  - `RedirectIfAuthenticated` — guards the login route itself.
  - `PreventBackMiddleware` — the real auth gate for `/admin/*` (checks `Auth::check()`, else redirects to login) plus sets no-cache headers so browser back-button doesn't reveal cached admin pages after logout.
  - `PreventBackHistory` wraps both groups.
  - Login also checks `is_active` on the user and branches redirect behavior on `role === 'Super Admin'` vs other roles (`User` model has `role`/`is_active` fillable fields, no formal roles/permissions package).

Admin CRUD is exposed via `Route::resource` for banners, infographics, webinars, BRS (statistical news releases), users, and "produk" (statistical products) — controllers live in `app/Http/Controllers/Admin/`.

### Livewire

Livewire **v4** (`livewire/livewire: ^4.0`, a newer major version — don't assume v2/v3 API/conventions when writing components) is used for interactive admin/content pieces (`app/Livewire/`, views in `resources/views/livewire/`): banner management, BRS, infographics, PRS (produk statistik), survey questions. Rich text editing uses `mantix/livewire-jodit-text-editor`.

### Frontend

Vite + Tailwind CSS v4 (`@tailwindcss/vite` plugin, no separate `tailwind.config.js`), SweetAlert2 for JS dialogs. Blade templates only — no SPA framework beyond Livewire's own reactivity.
