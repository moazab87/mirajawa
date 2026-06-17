# Dashboard Website Content Update

## 1. Existing sections updated

| Section | Changes |
|---------|---------|
| **Settings** | Key/value settings: `phone`, `since_year`, `background_image` (upload). Website tab in settings UI. |
| **Categories** | `color`, `status` (int `GeneralStatusEnum`). Language tabs on forms. |
| **Sliders** | Translatable `title`, `description`. `is_active` migrated to `status` (int enum). |
| **Products** | Translatable product detail fields, `product_group_id`, `status`, scopes `active`, `byCategory`, `byProductGroup`. |
| **Static pages** (`FixedPage`) | `slug`, `sub_title`, `description` (replaces `content`), `image`, `status`. Predefined system slugs only (see [Static Pages Slug Rules](#static-pages-slug-rules)). |

## 2. New dashboard sections

- Addresses
- Branches (+ `branch_images`)
- Product Groups
- FAQs
- Contact Messages (inbox: list/show/mark replied/delete)
- Information Requests (inbox)
- Profiles
- Histories
- Contact Information
- Information Blocks (`information_blocks` table)

## 3. New database tables

- `product_groups`
- `addresses`
- `branches`, `branch_images`
- `faqs`
- `contact_messages`
- `information_requests`
- `profiles`
- `histories`
- `contact_information`
- `information_blocks`

## 4. Updated database tables

- `categories` — `color`, `status`
- `sliders` — `title`, `description`, `status` (dropped `is_active`)
- `products` — translated JSON fields, `product_group_id`, `status`
- `fixed_pages` — `slug`, `sub_title`, `description`, `image`, `status` (dropped `content`)
- `histories` — `year` (unsigned small integer, nullable, indexed; not translated)

Settings remain key/value in `settings` table (no schema migration).

## 5. New enums

- `App\Enums\GeneralStatusEnum` — `INACTIVE = 0`, `ACTIVE = 1`
- `App\Enums\MessageStatusEnum` — `NEW = 0`, `REPLIED = 1`

Existing `StatusModelsEnum` unchanged (legacy tasks/projects).

## 6. New routes (prefix `/dashboard`, name `admin.*`)

Resource routes for: `productGroups`, `addresses`, `branches`, `faqs`, `profiles`, `histories`, `informationBlocks`, `contactInformation`.

Message routes (no create/edit):

- `contactMessages` + `POST contactMessages/{id}/mark-replied`
- `informationRequests` + `POST informationRequests/{id}/mark-replied`

Extra:

- `DELETE branches/{branch}/images/{image}`

## 7. Permissions

Project uses Spatie Permission with `RolesAndPermissionsSeeder` scanning `admin.*` routes. Re-run:

```bash
php artisan db:seed --class=RolesAndPermissionsSeeder
```

after deploying routes to register new permissions automatically.

## 8. New seeders

| Seeder | Purpose |
|--------|---------|
| `SettingsSeeder` | phone, since_year, background_image defaults |
| `CategorySeeder` | 3 sample categories with colors |
| `ProductGroupSeeder` | Groups per category |
| `FixedPageSeeder` | 11 required slugs via `updateOrCreate` |
| `ProductSeeder` | Sample product with new fields |
| `SliderSeeder` | Translated slider |
| `AddressSeeder`, `BranchSeeder`, `FaqSeeder`, etc. | Demo content |

All registered in `DatabaseSeeder`.

## 9. Seeder execution notes

- Safe to run individual seeders: `php artisan db:seed --class=FixedPageSeeder`
- Full `db:seed` may fail on `AdminTableSeeder` if admin email already exists (pre-existing).
- Seeders use find/update patterns to avoid duplicates where possible.
- Images in seeders are nullable (no file dependencies).

## 10. Required env/config

```env
GOOGLE_MAPS_KEY=your_google_maps_api_key
```

Config: `config/services.php` → `services.google_maps.key`

Used by address forms when key is set (`admin/shared/location.blade.php`).

## 11. Future frontend integration

- Use model scopes: `active()`, `latestFirst()`, `ordered()` (where applicable).
- Translations: Spatie JSON (`ar`, `en`, `ja`); display helper `translatedDisplay($model, 'field')` / `getDisplayTranslation()` with fallback order: current locale → ar → en → ja.
- Static pages: query `FixedPage` by `slug` + `active()` via `WebsiteContentService::fixedPage()` and `FixedPageSlugEnum`.
- Repeated blocks: `Profile`, `History`, `InformationBlock`, `ContactInformation`, `Faq`, `Address`, `Branch` with `active()`.
- Products: filter by `category_id`, `product_group_id`, `status`.

## 12. Assumptions

- **Fixed pages** kept as `FixedPage` model / `fixed_pages` table (not renamed to `static_pages`).
- **Information module** uses table `information_blocks` and model `InformationBlock` to avoid naming conflicts.
- CRUD forms use **language tabs** (`admin/shared/language-tabs.blade.php`); older modules may still use side-by-side fields until updated.
- Validation: Arabic required for primary translatable fields (`field.ar`), EN/JA nullable via `translatableFieldRules()`.
- Sliders keep **Attachment** morph for media; title/description are DB JSON fields.
- `AdminTableSeeder` not changed (may duplicate admin on full seed).

## 13. Manual review recommended

- Update **sliders** / **products** / **fixedPages** create/edit blades for full language-tab UX and new fields (partially done for categories/new modules).
- Copy new `route.php` / `admin.php` keys to **ar** and **ja** lang files (EN keys added).
- Run `RolesAndPermissionsSeeder` and assign permissions to roles if menu `@can` is enabled later.
- Review `SliderSeeder` / existing slider rows after `is_active` → `status` migration.
- Public API/contact form endpoints for messages (not added unless you wire web routes).
- `scripts/generate_admin_views.php` is a dev helper; safe to delete after review.

## Dashboard UI Translation

### Language files updated

| Locale | Files |
|--------|--------|
| English | `resources/lang/en/dashboard.php`, `resources/lang/en/validation_attributes.php` |
| Arabic | `resources/lang/ar/dashboard.php`, `resources/lang/ar/dashboard_validation_attributes.php` |
| Japanese | `resources/lang/ja/dashboard.php`, `resources/lang/ja/dashboard_validation_attributes.php` |

Also updated (backward compatibility + validation attribute merge):

- `resources/lang/{ar,en,ja}/validation.php` — merged dashboard field attributes
- `resources/lang/{ar,en,ja}/route.php` — new module menu keys (legacy `route.*` still works for Socials, etc.)

Existing `resources/lang/{ar,en,ja}/admin.php` remains for login, legacy screens, and web-facing strings.

### Translation keys added

- **Common UI:** `dashboard.create`, `edit`, `save`, `delete`, `status`, `search`, `filter`, field labels (`name`, `description`, `phone`, …)
- **Statuses:** `dashboard.statuses.active`, `inactive`, `new`, `replied`
- **Menu:** `dashboard.menu.website_content`, `products_section`, `contact_requests`
- **Per module:** `dashboard.{module}.index|create|edit|show|created_successfully|updated_successfully|deleted_successfully|status_updated_successfully`

Module keys use snake_case: `static_pages`, `product_groups`, `contact_messages`, `information_requests`, `contact_information`, `information`.

### Modules covered (dashboard UI)

Settings, categories, sliders, products, static pages (`fixedPages`), addresses, branches, product groups, FAQs, contact messages, information requests, profiles, histories, contact information, information blocks, socials (menu).

### Enum labels translation approach

`GeneralStatusEnum::label()` and `MessageStatusEnum::label()` return `__('dashboard.statuses.*')` so badge text follows the active app locale (`ar` / `en` / `ja` via session `Lang` middleware).

### Helpers

- `dashboard_module_key($routeOrFolder)` — maps route folder names to dashboard module keys
- `dashboard_trans($routeOrFolder, $suffix)` — shorthand for module CRUD titles/messages

### Label audit (website-content modules)

Completed pass on `resources/views/admin` for Settings, categories, sliders, products, static pages, addresses, branches, product groups, FAQs, contact messages, information requests, profiles, histories, contact information, information blocks, and shared partials (`language-tabs`, `status-select`, `deleteOne`, `product-translatable-fields`).

- Blade labels use `__('dashboard.*')` or `dashboard.{module}.*`; no hardcoded EN/AR/JA UI strings in those modules.
- `settings/includes/aboutus.blade.php` migrated from `admin.*` to `dashboard.settings.aboutus_*`.
- `products/create` and `products/edit` share `admin/shared/product-translatable-fields.blade.php`; edit includes `product_group_id` and `status-select`.
- Enums: `GeneralStatusEnum` / `MessageStatusEnum` labels use `dashboard.statuses.*`.
- `app/Http/Requests/Admin/*` rely on Laravel validation + merged attribute files (no custom English `messages()` in CRUD requests).

### Hardcoded labels not fully replaced (and why)

| Area | Reason |
|------|--------|
| `resources/views/admin/auth/login.blade.php` | Legacy login screen; still uses `admin.*` |
| `resources/views/admin/layouts/partials/navbar.blade.php`, `profile.blade.php`, `footer.blade.php` | Global shell; still `admin.*` |
| `resources/views/admin/users/*`, `projects/*`, `tasks/*` | Commented/disabled modules |
| `resources/views/admin/dashboard.blade.php` | Uses `__('Dashboard')` — not part of website-content scope |
| `resources/lang/*/admin.php` | Intentionally kept for non-dashboard / legacy strings |

Note: `resources/views/dashboard` does not exist; all dashboard UI lives under `resources/views/admin`.

### Switching dashboard locale

Set session language (existing flow): login page language toggle sets `Lang` session (`en`, `ar`, `ja`). `App\Http\Middleware\Locale` applies `app()->setLocale()`.

Verify: open `/dashboard` after switching language — menu, tables, forms, validation errors, and status badges should appear in the selected language.

## Static Pages Slug Rules

Static pages (`FixedPage` / `fixed_pages`) are **predefined system pages**, not open CRUD resources.

### Admin behavior

- **Allowed:** list, show, edit content (name, sub_title, description, image, status).
- **Not allowed:** create, delete, edit slug, bulk delete.

Routes: `Route::resource('fixedPages', ...)->only(['index', 'show', 'edit', 'update'])`.

Backend protection:

- `FixedPage` model blocks slug changes on update and blocks create/delete outside console (seeders).
- `FixedPageService` strips `slug` from update payload and rejects store/delete.
- `FixedPageController` returns 403 for create/store/destroy.

### Required slugs (`App\Enums\FixedPageSlugEnum`)

`privacy-policy`, `our-factory`, `welcome`, `history`, `why-us`, `products`, `company-information`, `about-us`, `information`, `business`, `greetings`

### Seeder

`FixedPageSeeder` uses `firstOrCreate(['slug' => ...])` with default translated names **only on first creation**. Re-running the seeder does not overwrite admin-edited content.

### Public website

- Fetch by slug only: `WebsiteContentService::fixedPage(FixedPageSlugEnum::WELCOME)` (or string slug).
- Do not fetch static pages by ID in public controllers.
- Do not hardcode page body content in Blade.

## Architecture alignment

- Spatie `HasTranslations` + JSON columns
- `BaseCrudRepository` + `*Service` layer
- Blade `x-admin.table` listings (not server-side DataTables)
- Uploads: `uploadImage()` / `Attachment` morph / `branch_images` table
