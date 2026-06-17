# MIRAJAWA Public Website Redesign

Documentation for the public frontend redesign completed on 2026-06-03.

## 1. Pages redesigned/created

| Page | Route | View |
|------|-------|------|
| Home | `/` | `resources/views/web/home.blade.php` |
| About Us | `/about-us` | `resources/views/web/pages/about.blade.php` |
| Company Profile | `/company-profile` | `resources/views/web/pages/company-profile.blade.php` |
| Business | `/business` | `resources/views/web/pages/business.blade.php` |
| Why MIRAJAWA | `/why-us` | `resources/views/web/pages/why-us.blade.php` |
| History | `/history` | `resources/views/web/pages/history.blade.php` |
| Branches & Facilities | `/branches` | `resources/views/web/pages/branches.blade.php` |
| Products catalog | `/products` | `resources/views/web/products/index.blade.php` |
| Product details | `/products/{id}` | `resources/views/web/products/show.blade.php` |
| Contact Us | `/contact` | `resources/views/web/contact/index.blade.php` |
| Request Information | `/request-information` | `resources/views/web/contact/request-information.blade.php` |
| Privacy Policy | `/privacy-policy` | `resources/views/web/pages/privacy.blade.php` |

Legacy routes `/categories` and `/categories/{id}` redirect to the products catalog.

## 2. Dashboard modules used in frontend

| Module | Usage |
|--------|--------|
| **Settings** | Logo, favicon, phone, since year, background image |
| **Sliders** | Homepage hero carousel |
| **Fixed Pages** | Page heroes and section content by fixed slug (`FixedPageSlugEnum`) via `WebsiteContentService::fixedPage()` |

### Static Pages Slug Rules

- Static pages are predefined system pages; slugs are not editable in the dashboard.
- Public site loads content by slug only (never by ID).
- Required slugs: `welcome`, `about-us`, `why-us`, `business`, `products`, `information`, `company-information`, `greetings`, `history`, `our-factory`, `privacy-policy`.
- See `dashboard-website-content-update.md` for admin restrictions and seeder behavior.

| **Categories** | Product catalog filters, homepage/footer links |
| **Product Groups** | Product catalog filters |
| **Products** | Catalog listing, detail pages, related products |
| **Profiles** | About/company intro blocks |
| **Histories** | Timeline on home and history page |
| **Activites** | Philosophy, strengths, business cards, roadmap |
| **Contact Information** | Contact page cards |
| **Addresses** | Contact page locations + map links |
| **Branches** | Facilities preview and branches page |
| **FAQs** | Contact page accordion |
| **Contact Messages** | Public contact form storage |
| **Information Requests** | Catalog/information request form storage |
| **Social** | Footer social links |

All publishable content uses `GeneralStatusEnum::ACTIVE` via the `active()` scope.

## 3. Routes added/updated

Defined in `routes/web.php` with `web.*` name prefix:

- `web.home`, `web.about`, `web.company-profile`, `web.business`, `web.why-us`, `web.history`, `web.branches`, `web.privacy`
- `web.products.index`, `web.products.show`
- `web.contact.index`, `web.contact.store`
- `web.request-information.create`, `web.request-information.store`
- `web.change.language` (existing)

## 4. Views/components added/updated

**Layout & partials**
- `resources/views/web/layouts/app.blade.php` — redesigned layout
- `resources/views/web/partials/header.blade.php`
- `resources/views/web/partials/footer.blade.php`
- `resources/views/web/partials/page-hero.blade.php`
- `resources/views/web/partials/section-heading.blade.php`
- `resources/views/web/partials/cta-section.blade.php`

**Components**
- `resources/views/web/components/product-card.blade.php`
- `resources/views/web/components/category-card.blade.php`

**Assets**
- `public/css/mirajawa-website.css` — dark green / gold corporate theme

**Backend**
- `app/Services/Web/WebsiteContentService.php`
- `app/Http/View/Composers/WebsiteComposer.php`
- Web controllers under `app/Http/Controllers/Web/`

## 5. Translation files updated

New dedicated public UI files (do not use admin lang keys in views):

- `resources/lang/en/website.php`
- `resources/lang/ar/website.php`
- `resources/lang/ja/website.php`

RTL/LTR direction continues via `resources/lang/{locale}/route.php` (`dir` key).

## 6. Forms implemented

**Contact form** (`POST /contact`)
- Fields: name, email, company_name, phone, message
- Validation: `App\Http\Requests\Web\ContactMessageRequest`
- Stores in `contact_messages` with `MessageStatusEnum::NEW`

**Request information form** (`POST /request-information`)
- Fields: name, email, company_name, phone, address, postal_code, message
- Validation: `App\Http\Requests\Web\InformationRequestFormRequest`
- Stores in `information_requests` with `MessageStatusEnum::NEW`

No login required. Success messages use translated flash strings.

## 7. Product catalog behavior

- Corporate catalog only — no cart, checkout, or payment
- Lists active products with category/group filters and name search
- Product detail shows all translatable specification fields from dashboard
- CTA links to contact and request-information pages
- Related products from same category

## 8. SEO notes

- Each page sets `@section('title')` and `@section('meta_description')`
- Layout includes `<meta name="description">` and `<link rel="canonical">`
- Product pages use product name and description for meta
- Static pages use dashboard `FixedPage` content where available

## 9. Responsive notes

- Sticky header with mobile slide-out navigation
- Hero, grids, timeline, forms, and footer tested for mobile/tablet/desktop breakpoints
- Arabic RTL supported via `[dir="rtl"]` CSS rules for timeline and navigation drawer
- Bootstrap 5 grid used for form layouts

## 10. Assumptions made

- No uploaded PDF/PPTX company profile files were found in the repository; visual direction follows the brief (dark green, gold, beige) and Nile International–style corporate structure as inspiration only.
- **Information blocks** first 3 items = philosophy (Mission/Vision/Value); items 4+ = strengths on homepage; last 3 on business page = roadmap when ≥3 blocks exist.
- **Fixed page seeders** have empty descriptions — pages render structure correctly; client must populate content in dashboard.
- **Category images** are not in the database schema; categories use color bars and icons.
- **Email notifications** for contact/request forms are not implemented (not present in project); messages are stored only.
- Default hero fallback text uses translation keys when sliders/pages have no content.

## 11. Content needing client review

Populate in dashboard (currently seeded with minimal/empty text):

- All **Fixed Pages** descriptions (welcome, about-us, business, why-us, history, greetings, etc.)
- **Slider** images and translated titles/descriptions
- **Settings**: phone, logo per locale, background_image
- **Profiles**, **Histories**, **Information Blocks** with full company story from profile decks
- **Branch** images and facility descriptions
- **Products** beyond sample strawberry product
- **FAQs** for Japanese B2B audience

## 12. Images/assets to replace

- Settings logo and background_image (upload via dashboard)
- Slider hero photography (Egypt agriculture / Japan connection)
- Product and branch gallery images
- Fixed page hero images (`FixedPage.image`)
- Contact information card images
- Favicon via settings

---

**Reference sites reviewed:** [mirajawa.com](https://mirajawa.com), [nile-international.com](https://nile-international.com) (layout inspiration only).

**Admin dashboard:** unchanged; all new content remains manageable from existing dashboard modules.

## Histories `year` field (update)

- `histories.year` — integer timeline year (not translated); nullable in DB for safe migration, required on create/update forms.
- Public timeline orders active records by `year` ascending (records without year appear last).
- Dashboard listing orders by `year` descending.
- `HistorySeeder` seeds milestones: 2011, 2020, 2022, 2025, 2026.
