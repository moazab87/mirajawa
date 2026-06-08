# MIRAJAWA Public Website — UI Polish

Documentation for the UI/UX polish pass applied on top of the existing public website redesign.

## 1. Pages reviewed

All public pages were reviewed and polished:

- Home
- About Us
- Company Profile
- Business
- Products (listing)
- Product Details
- Why MIRAJAWA
- History
- Branches
- Contact Us
- Request Information
- Privacy Policy

## 2. UI improvements made

### Global design system (`public/css/mirajawa-website.css` v2)
- Refined color tokens (deeper green, softer gold, warm beige, gray-soft surfaces)
- Consistent spacing scale via `--mj-section-y` and utility classes
- Locale-aware typography (`Cairo` for Arabic, `Noto Sans JP` for Japanese, `Noto Sans` for English)
- Unified card, badge, button, form, and section heading styles
- Subtle scroll-reveal animation (`.mj-reveal`) with `prefers-reduced-motion` support
- Improved pagination, accordion, empty state, and contact card styling

### Header / navigation
- Restructured desktop vs mobile navigation behavior
- Mobile drawer with close button, backdrop blur overlay, Escape key support
- Improved active link styling and accessible menu labels
- Language switcher and CTAs polished for both breakpoints

### Homepage hero
- Stronger gradient overlay for text readability
- Subtle Ken Burns zoom on slide backgrounds
- Pill-style slide indicators with click navigation
- Ghost CTA button variant for secondary action
- Scroll-down affordance on desktop
- Improved aria labels for slides

### Section headings
- Consistent eyebrow + title + gold accent line + description pattern
- Reusable partial with optional section numbers

### Products
- Category filter pills above advanced filter form
- Product cards with category/group badges and dedicated footer CTA
- Product detail: main gallery + thumbnail switcher, sticky info panel on desktop
- Specifications panel with B2B catalog styling (not e-commerce)
- Professional empty state when no products match filters

### About / company storytelling
- Founder message uses dedicated two-column layout with portrait aspect ratio
- Page hero images use consistent framed treatment
- Info cards unified via reusable component

### History / timeline
- Timeline items rendered as elevated cards on the gold/green line
- Improved spacing and mobile stacking

### Forms
- Contact and request forms use `.mj-form-card` with improved labels, focus rings, validation display
- Success alerts with icon treatment
- Autocomplete attributes for accessibility

### Footer
- Gold top border accent, semantic heading levels, improved link hover
- Removed inline styles; uses CSS classes

## 3. Components / partials improved

| File | Changes |
|------|---------|
| `web/partials/header.blade.php` | Mobile close btn, aria labels, nav structure |
| `web/partials/footer.blade.php` | Semantic headings, CSS classes |
| `web/partials/section-heading.blade.php` | Gold accent line, reveal class |
| `web/partials/cta-section.blade.php` | Removed inline styles |
| `web/components/product-card.blade.php` | Badges, footer CTA, semantic article |
| `web/components/category-card.blade.php` | Footer CTA, reveal |
| `web/components/info-card.blade.php` | **New** unified info block |
| `web/components/timeline-item.blade.php` | **New** card-style timeline entry |
| `web/components/empty-state.blade.php` | **New** empty results UI |

## 4. CSS / assets changed

| Asset | Change |
|-------|--------|
| `public/css/mirajawa-website.css` | Major polish pass (v2) |
| `public/js/mirajawa-website.js` | **New** — header, hero slider, scroll reveal |
| `resources/views/web/layouts/app.blade.php` | External JS, cache bust v2 |

## 5. Translation files updated

Added keys to `resources/lang/{en,ar,ja}/website.php`:

- `no_products_hint`
- `main_navigation`, `open_menu`, `close_menu`
- `hero_slides`, `slide`, `scroll_down`
- `product_specifications`
- `request_message_placeholder`

## 6. Responsive fixes

- Mobile nav drawer works in LTR and RTL
- Product spec grid stacks on mobile
- Founder block stacks portrait above text on small screens
- Hero min-height uses `clamp()` for tablet/mobile
- Grid breakpoints: 1 col mobile, 2 col tablet, 3–4 col desktop
- Sticky product info panel on desktop only

## 7. RTL / LTR fixes

- Timeline uses `padding-inline-start` and `inset-inline-start`
- Hero dots centered with RTL transform override
- Arrow icons flip in RTL on product card CTAs
- Footer link hover uses `padding-inline-start`
- Breadcrumb and form layouts follow document direction

## 8. SEO / accessibility improvements

- Semantic `<main id="main-content">`, `<article>`, `<nav>`, `<figure>`
- Page-level `<h1>` in hero partials; section `<h2>` in headings
- Form labels linked to inputs; required fields marked
- Icon-only buttons have `aria-label`
- Image `alt` attributes on content images
- `role="alert"` on success messages
- `loading="lazy"` on below-fold images; eager on logo/hero main image
- Focus-visible styles on buttons and menu controls

## 9. Remaining notes for manual review

- **Dashboard content**: Many fixed pages still have empty descriptions in seed data — populate for full visual impact
- **Hero photography**: Upload high-quality slider/background images via dashboard settings
- **Product images**: Ensure all products have at least one attachment for best catalog presentation
- **Branch/founder images**: Upload via dashboard for About and Branches pages
- **Browser QA**: Manually verify on real devices (iOS Safari, Android Chrome) and all three locales

## 10. Assumptions made

- Existing routes, controllers, form handlers, and dashboard integration were **not modified**
- No new dependencies added beyond existing Bootstrap, Bootstrap Icons, Fancybox
- Scroll reveal and hero autoplay are subtle and disabled for `prefers-reduced-motion`
- Category color on category cards still uses inline `background` from dashboard `color` field (dynamic data)
- Hero slide background URLs remain inline where driven by dashboard media paths

---

**Previous documentation:** See `public-website-redesign.md` for initial redesign scope, routes, and dashboard module mapping.
