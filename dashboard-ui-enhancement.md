# Admin Dashboard UI Enhancement

## Visual goals

- Light, calm, professional admin interface inspired by modern RTL dashboards
- Soft gray page background (`#f1f5f9`) with white elevated cards
- Primary blue (`#2563eb`) for main actions and active navigation
- Large, consistent border radius and soft shadows
- Clear typography hierarchy (titles, labels, muted helper text)
- RTL/LTR-safe layout using logical CSS where applicable
- Responsive tables, forms, and toolbar stacking on small screens

## Key changes made

### Design system (CSS)

- **`public/admin/custom/css/dashboard-ui.css`** — central design tokens and global overrides for the Sneat/Bootstrap template
- Loaded from **`resources/views/admin/layouts/app.blade.php`** and **`resources/views/admin/auth/login.blade.php`**
- Tokens: colors, radii, shadows, input/button heights

### Layout & chrome

- **Sidebar** (`resources/views/admin/layouts/partials/menu.blade.php`) — cleaner logo sizing, active state, spacing
- **Topbar** (`resources/views/admin/layouts/partials/navbar.blade.php`) — simplified navbar, removed debug language `alert`, rounded container
- **Alerts** (`resources/views/admin/layouts/partials/alerts.blade.php`) — softer success/error styling with icons
- **Login** (`resources/views/admin/auth/login.blade.php`) — valid HTML structure, centered auth card, language switcher, improved form UX
- **Settings** — `dash-card` styling on main settings panel

### Reusable Blade components

| Component | Path | Purpose |
|-----------|------|---------|
| `x-admin.breadcrumb` | `resources/views/components/admin/breadcrumb.blade.php` | Page path navigation |
| `x-admin.table` | `resources/views/components/admin/table.blade.php` | List pages: header, search, table |
| `x-admin.buttons` | `resources/views/components/admin/buttons.blade.php` | Row actions (view/edit/delete) |
| `x-admin.search-form` | `resources/views/components/admin/search-form.blade.php` | Index search bar |
| `x-admin.status-badge` | `resources/views/components/admin/status-badge.blade.php` | Status chips |
| `x-admin.form-card` | `resources/views/components/admin/form-card.blade.php` | Create/edit form wrapper |
| `x-admin.form-actions` | `resources/views/components/admin/form-actions.blade.php` | Submit + back button row |
| `x-admin.show-page` | `resources/views/components/admin/show-page.blade.php` | Detail/show layout |
| `x-admin.detail-item` | `resources/views/components/admin/detail-item.blade.php` | Label/value block |
| `x-admin.translatable-show` | `resources/views/components/admin/translatable-show.blade.php` | Multi-language show pages |

### Shared partials

- **`resources/views/admin/shared/language-tabs.blade.php`** — improved tab styling
- **`resources/views/admin/shared/form-actions.blade.php`** — legacy bridge to `x-admin.form-actions`

### Pages updated as reference implementations

- Categories: index, create, edit, show
- Profiles, FAQs, product groups, branches, histories, information blocks: show pages
- Contact messages: show page
- Pagination: `resources/views/vendor/pagination/bootstrap-4.blade.php`

## Reusable UI patterns

### New index page

```blade
@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <x-admin.breadcrumb :links="[...]" />
    <x-admin.table
        :headers="[...]"
        :title="$title"
        :create-route="$createRoute"
        :button-text="__('dashboard.add')"
        :search="true"
        :index-route="$route">
        @forelse($models as $model)
            <tr>...</tr>
        @empty
            <tr class="dash-empty-state">
                <td colspan="N"><i class="bx bx-data"></i> {{ __('dashboard.no_data_available') }}</td>
            </tr>
        @endforelse
    </x-admin.table>
</div>
@endsection
```

### New create/edit form

```blade
<x-admin.form-card>
    <form ...>
        @include('admin.layouts.partials.alerts')
        <!-- fields -->
        <x-admin.form-actions :submit-text="__('dashboard.save')" :back-url="$route" />
    </form>
</x-admin.form-card>
```

### Translatable show page

```blade
<x-admin.translatable-show
    :model="$model"
    :fields="['name', 'description']"
    :edit-route="route($editRoute, $model->id)"
    :back-route="$route"
    icon="bx-file"
/>
```

### Custom show page

Use `x-admin.show-page` + `x-admin.detail-item` (see categories show).

## CSS utility classes (optional)

- `dash-card` — white panel with shadow
- `dash-page-title` / `dash-text-muted` — typography
- `dash-form-actions` — form footer button row
- `dash-empty-state` — empty table row
- `dash-btn-icon` — compact table action buttons

## Notes for future pages/modules

1. **Do not add inline colors** — extend `dashboard-ui.css` tokens or use Bootstrap `btn-primary`, `bg-label-*` badges.
2. **Prefer components** over copying card/table markup.
3. **Keep `$active` menu keys** unchanged for sidebar highlighting.
4. **Forms**: use `form-control` / `form-select`; focus states are global.
5. **RTL**: avoid hardcoded `text-left`/`margin-left`; use Bootstrap spacing utilities (`ms-*`, `me-*`) which flip in RTL.
6. **Legacy pages** (users, tasks, clients, etc.) still benefit from global CSS even before migrating to new components.

## Areas that may need manual polish

- Complex show pages (users, tasks, products with images/galleries) — migrate to `show-page` + `detail-item` when touched
- Legacy create/edit forms still using `btn-outline-warning` for back — visually normalized via CSS; replace with `x-admin.form-actions` when editing those files
- DataTables-heavy pages (if any custom JS tables) — verify script compatibility
- File upload / map partials — functional; optional spacing tweaks per module
- Dashboard home widgets (`admin/dashboard/details/*`) — receive global card styling only

## Files touched (summary)

- `public/admin/custom/css/dashboard-ui.css` (new)
- `resources/views/admin/layouts/app.blade.php`
- `resources/views/admin/layouts/partials/{menu,navbar,alerts}.blade.php`
- `resources/views/admin/auth/login.blade.php`
- `resources/views/components/admin/*.blade.php` (created/updated)
- `resources/views/admin/shared/{language-tabs,form-actions}.blade.php`
- `resources/views/vendor/pagination/bootstrap-4.blade.php`
- Selected CRUD views under `resources/views/admin/{categories,profiles,faqs,...}`
