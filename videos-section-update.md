# Videos Section Update

## Overview

Added a full Videos module to the MIRAJAWA dashboard and a public `/videos` page with alternating video cards and scroll-triggered muted autoplay.

## Database

**Table:** `videos`

| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| video | string | Required filename |
| title | json | Nullable, translatable (ar/en/ja) |
| description | json | Nullable, translatable (ar/en/ja) |
| status | unsignedTinyInteger | `GeneralStatusEnum` (0=inactive, 1=active) |
| sort_order | unsignedInteger | Default 0 |
| timestamps | | |
| softDeletes | | |

**Migration:** `database/migrations/2026_06_03_100014_create_videos_table.php`

## Dashboard Module

- **Model:** `App\Models\Video`
- **Service:** `App\Services\Admin\VideoService`
- **Controller:** `App\Http\Controllers\Admin\VideoController`
- **Requests:** `App\Http\Requests\Admin\Video\StoreRequest`, `UpdateRequest`
- **Views:** `resources/views/admin/videos/*`
- **Route:** `admin.videos.*` (resource)
- **Sidebar:** Website Content → Videos

### Upload path

Videos are stored at:

```
public/uploads/videos/{filename}
```

Public URL:

```
/uploads/videos/{filename}
```

Model accessor: `$video->video_url`

### Validation

- **Create:** video required (`mp4`, `webm`, `mov`, max 100MB)
- **Update:** video optional; existing file kept if not replaced
- Title/description optional in all languages
- Status required (int enum)
- sort_order optional integer ≥ 0

### No seeder

No `VideoSeeder` was added to avoid broken demo file references without real video assets.

## Public Website

- **Route:** `GET /videos` → `web.videos.index`
- **Controller:** `App\Http\Controllers\Web\VideoController`
- **View:** `resources/views/web/pages/videos.blade.php`
- **Query:** `Video::active()->ordered()->get()` via `WebsiteContentService::videos()`

### Navbar & footer

- Desktop/mobile navbar: **Videos** (`website.videos`)
- Footer quick links: Videos

### Layout

- Page hero + breadcrumbs
- Vertical stack of alternating cards:
  - Odd cards: video left, text right (LTR)
  - Even cards: video right, text left
- Mobile: video on top, text below
- Empty state when no active videos

### Scroll autoplay

Implemented in `public/js/mirajawa-website.js`:

- `IntersectionObserver` on `.js-scroll-video`
- Plays muted when ≥55% visible
- Pauses when leaving viewport
- Only one video plays at a time
- `muted`, `playsinline`, `controls`, `preload="metadata"`

## Translations

Updated:

- `resources/lang/{ar,en,ja}/website.php`
- `resources/lang/{ar,en,ja}/dashboard.php`
- `resources/lang/{ar,en,ja}/route.php`

## Server upload notes

For ~2 minute video files (up to 100MB validation), ensure PHP/server settings allow large uploads:

```ini
upload_max_filesize = 128M
post_max_size = 128M
max_execution_time = 300
memory_limit = 256M
```

Also verify web server body size limits (nginx `client_max_body_size`, etc.).

## Future consideration

For many videos or very large files, consider external hosting/CDN (YouTube, Vimeo, S3 + CloudFront) to reduce server load and improve delivery.

## Assumptions

- Spatie Translatable JSON columns (same as FAQs, Sliders, etc.)
- Soft deletes enabled
- Rich text editor used for optional multilingual descriptions
- Permissions/roles not extended (project does not use granular permissions on other similar modules)
