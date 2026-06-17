# Content Editor & Translations Update

Documentation for rich text editor integration and UI translation pass (2026-06-17).

## Rich text editor

### Library
- **TinyMCE 7** (GPL, CDN) — `https://cdn.jsdelivr.net/npm/tinymce@7.5.1/tinymce.min.js`
- No prior editor existed in the project; TinyMCE was chosen for RTL/LTR support, tab compatibility, and lightweight toolbar.

### Reusable assets
| Asset | Path |
|-------|------|
| JS initializer | `public/admin/custom/js/rich-editor.js` |
| Dashboard CSS | `public/admin/custom/css/rich-editor.css` |
| Blade component | `resources/views/components/admin/rich-editor.blade.php` |
| Language tabs (auto-editor) | `resources/views/admin/shared/language-tabs.blade.php` |

### How it works
- Textareas with class `mj-rich-editor` and `data-lang="{ar|en|ja}"` are initialized by `rich-editor.js`.
- `language-tabs.blade.php` automatically upgrades these fields from `textarea` to rich editor:
  - `description`, `answer`, `map_desc`, `how_to_use`, `storage_conditions`, `notes`
- Short fields remain plain inputs/textareas (`name`, `sub_title`, `packaging`, `question`, etc.).
- Editors init on page load (active tab) and when a language tab is shown.
- Form submit triggers `tinymce.triggerSave()` to sync HTML back to textareas.
- Arabic tabs use RTL directionality; EN/JA use LTR.

### Modules covered (via language tabs)
- Static pages (`fixedPages/edit`)
- Sliders
- Products (description, how_to_use, storage_conditions, notes — packaging stays plain textarea)
- Categories
- FAQs (answer)
- Profiles
- Histories
- Information blocks
- Contact information
- Addresses (description, map_desc)
- Branches

### Admin show pages
- `components/admin/translatable-show.blade.php` renders rich fields with `{!! !!}` inside `.mj-admin-rich-content`.
- Static page show view updated for HTML description.

## Public website rich content

### CSS
- Enhanced `.mj-content` in `public/css/mirajawa-website.css` (v5):
  - Links, strong, blockquote, tables, images
  - RTL text alignment for Arabic

### Rendering rules
- **Trusted admin content** — rendered with `{!! !!}` inside `.mj-content` (pages, products, FAQs, profiles, branches, etc.).
- **User-submitted messages** — escaped with `{{ }}` (contact messages, information requests).
- **Card previews / excerpts** — `Str::limit(strip_tags(...))` to avoid broken HTML in teasers.

## UI translations

### Website (`resources/lang/{ar,en,ja}/website.php`)
Added/fixed keys:
- `browse_categories`, `back_to_categories`, `back_to_products`, `no_products_available`
- `search`, `all`
- Fixed JA `all_rights_reserved`
- Fixed AR `request_message_placeholder`

Legacy category views updated to use `website.*` instead of `admin.*`.

### Dashboard
Existing `dashboard.php` files (ar/en/ja) already cover module CRUD, statuses, and static page rules. Enum labels use `__('dashboard.statuses.*')` via `GeneralStatusEnum` and `MessageStatusEnum`.

### Validation attributes
Existing files cover nested translatable fields:
- `resources/lang/en/validation_attributes.php`
- `resources/lang/ar/dashboard_validation_attributes.php`
- `resources/lang/ja/dashboard_validation_attributes.php`

Merged into `validation.php` per locale.

## Remaining manual review

| Area | Notes |
|------|--------|
| `admin/auth/login.blade.php` | Legacy; still uses `admin.*` |
| `admin/users`, `projects`, `tasks`, `clients`, `roles` | Disabled/legacy modules; not part of website content scope |
| `admin/socials` | Uses `admin.*` labels |
| TinyMCE CDN | Requires network in admin; swap to self-hosted assets if offline admin is needed |

## Verification checklist

1. Open any module edit form with language tabs → description/answer fields show TinyMCE.
2. Switch AR/EN/JA tabs → editor initializes and direction matches language.
3. Save content with lists/links → public page displays formatted HTML in `.mj-content`.
4. Contact message show → message remains plain text (escaped).
5. Switch site language ar/en/ja → navigation, buttons, forms use `website.php` keys.
