# Site Pages – Complete Reference & Flowcharts

## System Overview

```
┌─────────────────────────────────────────────────────────────────┐
│                         LAW STUDENTS                             │
│                  Policy Pages System v1.0                        │
└─────────────────────────────────────────────────────────────────┘

                   ┌──────────────────┐
                   │  Public Pages    │
                   │  (/privacy-etc)  │
                   └────────┬─────────┘
                            │
                            ↓
                   ┌──────────────────┐
              ┌────│  Site Pages DB   │────┐
              │    │ (4 policies)     │    │
              │    └──────────────────┘    │
              │                            │
              ↓                            ↓
    ┌──────────────────┐        ┌──────────────────┐
    │ Frontend Routes  │        │  Admin Routes    │
    │ (Dynamic View)   │        │  (CRUD + Reset)  │
    └──────────────────┘        └──────────────────┘
              │                            │
              ↓                            ↓
    ┌──────────────────┐        ┌──────────────────┐
    │  End Users See   │        │  Admin Edits in  │
    │  Latest Content  │        │  Quill Editor    │
    └──────────────────┘        └──────────────────┘
                                          │
                                          ↓
                                   ┌────────────┐
                                   │ Save + Sync│
                                   │ to Database│
                                   └────────────┘
```

---

## User Journey: Admin Edits a Policy

```
Admin logs in to /admin
    ↓
Admin Sidebar → Frontend → Site Pages
    ↓
/admin/site-pages (List View)
    ├─ Privacy Policy [Edit] [Reset]
    ├─ Terms & Conditions [Edit] [Reset]
    ├─ Disclaimer [Edit] [Reset]
    └─ Refund Policy [Edit] [Reset]
    ↓
Click [Edit] on Refund Policy
    ↓
GET /admin/site-pages-edit/4
    ↓
SitePageController::edit(4)
    └─ Queries: SitePage::findOrFail(4)
    └─ Loads current content into Quill editor
    ↓
Admin sees form:
    ├─ Title: "Refund Policy" (read-only)
    ├─ Slug: "refund-policy" (read-only)
    └─ Content: [Quill editor with current HTML]
    ↓
Admin modifies text (e.g., "7 days" → "14 days")
    ↓
Admin clicks [Save Changes]
    ↓
Form submission:
    ├─ Quill syncs HTML to hidden #content input
    └─ POST /admin/site-pages-update/4
    ↓
SitePageController::update(Request, 4)
    ├─ Validates: title required, content required
    ├─ Updates: SitePage::findOrFail(4)->update([...])
    │   ├─ title = "Refund Policy"
    │   ├─ content = "<p>14 days...</p>" (HTML from Quill)
    │   └─ last_updated = now()
    └─ Redirects: route('admin.listsitepages') with success message
    ↓
Admin sees success flash:
    "Page updated successfully."
    ↓
Admin confirms on public site:
    ├─ Visits /refund-policy
    └─ Sees "14 days" immediately (no caching)
```

---

## User Journey: Public Visitor Views Policy

```
Visitor types /refund-policy in browser
    ↓
Routes: GET /refund-policy
    ├─ Matches: Route::get('refund-policy', [SitePageController::class, 'show'])
    │   ├─ defaults('slug', 'refund-policy')
    │   ├─ name('refund')
    └─ Dispatches: Frontend\SitePageController::show('refund-policy')
    ↓
Controller fetches data:
    └─ $page = SitePage::where('slug', 'refund-policy')->firstOrFail()
       └─ Database query returns:
          ├─ id: 4
          ├─ slug: "refund-policy"
          ├─ title: "Refund Policy"
          ├─ content: "<p><strong>Sample policy...</strong><h2>1. Free material</h2>..."
          └─ last_updated: 2026-09-24 15:30:00
    ↓
Controller renders:
    └─ view('pages.site-page', [
       ├─ 'pageTitle' => 'Refund Policy',
       └─ 'page' => $page
    ])
    ↓
Template renders:
    └─ @extends('pages.layout')
       ├─ Extends inherited layout (same as static pages)
       ├─ Hero section with "Refund Policy" title
       └─ Article with {!! $page->content !!}
           └─ Raw HTML displayed (from Quill)
    ↓
Visitor sees page in browser
    ├─ Design: identical to static pages
    ├─ Content: dynamic from database
    └─ URL: /refund-policy (same as always)
```

---

## Database Schema Diagram

```
┌────────────────────────────────────────────────────────┐
│                    site_pages                          │
├────────────────────────────────────────────────────────┤
│ Field          │ Type        │ Notes                  │
├────────────────────────────────────────────────────────┤
│ id             │ BIGINT (PK) │ Auto-increment         │
├────────────────────────────────────────────────────────┤
│ slug           │ VARCHAR(255)│ UNIQUE, e.g.           │
│                │ UNIQUE      │ "privacy-policy"       │
├────────────────────────────────────────────────────────┤
│ title          │ VARCHAR(255)│ e.g. "Privacy Policy"  │
├────────────────────────────────────────────────────────┤
│ content        │ LONGTEXT    │ HTML from Quill editor │
├────────────────────────────────────────────────────────┤
│ last_updated   │ TIMESTAMP   │ Manual update time     │
├────────────────────────────────────────────────────────┤
│ created_at     │ TIMESTAMP   │ Laravel auto           │
├────────────────────────────────────────────────────────┤
│ updated_at     │ TIMESTAMP   │ Laravel auto           │
└────────────────────────────────────────────────────────┘

Indexes:
  PRIMARY KEY (id)
  UNIQUE KEY (slug)

Initial Data (from SitePageSeeder):
  1. privacy-policy → Privacy Policy
  2. terms-and-conditions → Terms & Conditions
  3. disclaimer → Disclaimer
  4. refund-policy → Refund Policy
```

---

## Controller Layer Architecture

```
┌──────────────────────────────────────────────────────────┐
│                  Frontend Routes                         │
├──────────────────────────────────────────────────────────┤
│ /privacy-policy → SitePageController::show('privacy')   │
│ /terms-and-conditions → SitePageController::show('term')│
│ /disclaimer → SitePageController::show('disclaimer')    │
│ /refund-policy → SitePageController::show('refund')     │
└──────────────────────────────────────────────────────────┘
              │                           ↓
              └─→ SitePage Model ←─ SitePageController
                      ↓
                 Query: where('slug', $slug)
                 Return: $page object
                      ↓
              Render: pages/site-page.blade.php


┌──────────────────────────────────────────────────────────┐
│                   Admin Routes                           │
├──────────────────────────────────────────────────────────┤
│ /admin/site-pages → SitePageController::index()         │
│ /admin/site-pages-edit/{id} → SitePageController::edit()│
│ /admin/site-pages-update/{id} → SitePageController::upd │
│ /admin/site-pages-reset/{id} → SitePageController::rese │
└──────────────────────────────────────────────────────────┘
              │
              ↓
         Middleware: admin.auth
              │
              ↓
         SitePageController (Admin)
         ├─ index() → Query all pages → admin/site-pages/list.blade.php
         ├─ edit() → Query page by ID → admin/site-pages/edit.blade.php
         ├─ update() → Validate + Save → Redirect with flash
         └─ reset() → Restore defaults → Redirect with flash
              │
              ↓
         SitePage Model
         ├─ Fetch
         ├─ Create
         ├─ Update
         └─ Delete
              │
              ↓
         MySQL: site_pages table
```

---

## View Hierarchy

### Frontend Pages

```
pages/layout.blade.php (Main template for all policies)
├─ Hero section
│  └─ @yield('pageTitle')
├─ Page content section
│  └─ @yield('doc')
│     └─ Sub-template extends this
│
Specific policy templates (now singular template for all):
└─ pages/site-page.blade.php
   ├─ Extends pages/layout
   ├─ @section('doc')
   └─ <article class="doc-card">
       └─ {!! $page->content !!}

OLD (Static - no longer used):
  pages/privacy-policy.blade.php (hardcoded HTML)
  pages/terms.blade.php (hardcoded HTML)
  pages/disclaimer.blade.php (hardcoded HTML)
  pages/refund-policy.blade.php (hardcoded HTML)

NEW (Dynamic - single template for all):
  pages/site-page.blade.php (displays $page->content)
```

### Admin Pages

```
layouts/partials/admin/dashboard.blade.php (Main admin layout)
├─ Navigation sidebar
│  └─ Frontend section
│     └─ Site Pages link (NEW)
├─ Header
└─ Main content area
   └─ @yield content

Admin page templates:
├─ admin/site-pages/list.blade.php
│  ├─ Table of all 4 pages
│  ├─ Edit button per page
│  ├─ Reset button per page
│  └─ Pagination
│
└─ admin/site-pages/edit.blade.php
   ├─ Title field (read-only)
   ├─ Slug field (read-only)
   ├─ Quill editor (#editor div)
   ├─ Hidden content input
   └─ Save/Cancel buttons
```

---

## Request-Response Flow Diagram

### Admin Edit Flow

```
         CLIENT                          SERVER
         ───────                         ──────

┌──────────────────────────────────────────────────────┐
│ 1. Admin clicks Edit on Refund Policy                │
└──────────────────────────────────────────────────────┘
                  ↓
        GET /admin/site-pages-edit/4
                  ↓
            Middleware checks:
            └─ admin.auth ✓
                  ↓
       SitePageController::edit(4)
            └─ SELECT * FROM site_pages WHERE id=4
                  ↓
       Loads into view with Quill editor
                  ↓
 ┌─────────────────────────────────────┐
 │ Response: edit.blade.php with Quill │
 └─────────────────────────────────────┘
                  ↓
 Admin sees Quill editor with content
 Admin edits text (client-side JS)
                  ↓
┌──────────────────────────────────────────────────────┐
│ 2. Admin clicks Save Changes                         │
└──────────────────────────────────────────────────────┘
                  ↓
   Quill syncs HTML to #content input
                  ↓
   Form POST /admin/site-pages-update/4
            └─ title: "Refund Policy"
            └─ content: "<p>14 days...</p>" (HTML)
                  ↓
            Middleware checks:
            └─ admin.auth ✓
                  ↓
       SitePageController::update(Request, 4)
            ├─ Validates request data
            └─ UPDATE site_pages SET content=?, title=?, last_updated=NOW() WHERE id=4
                  ↓
       Redirect: route('admin.listsitepages')
            └─ with('success', 'Page updated successfully.')
                  ↓
 ┌──────────────────────────────────────────┐
 │ Response: Redirect (303 See Other)      │
 │ Location: /admin/site-pages             │
 └──────────────────────────────────────────┘
                  ↓
 Browser loads /admin/site-pages
                  ↓
 Admin sees success message
 Admin confirms on public site
```

### Public Visit Flow

```
         CLIENT                          SERVER
         ───────                         ──────

┌──────────────────────────────────────────────────────┐
│ Visitor types /refund-policy                         │
└──────────────────────────────────────────────────────┘
                  ↓
        GET /refund-policy
                  ↓
    Route matches with defaults('slug', 'refund-policy')
                  ↓
    SitePageController::show('refund-policy')
            └─ SELECT * FROM site_pages WHERE slug='refund-policy'
                  ↓
    Return view('pages.site-page', [
        'pageTitle' => 'Refund Policy',
        'page' => $page
    ])
                  ↓
    Blade renders site-page.blade.php
    ├─ Extends pages/layout
    ├─ Hero: <h1>Refund Policy</h1>
    └─ Content: <article class="doc-card">
                  {!! $page->content !!}
                </article>
                  ↓
 ┌─────────────────────────────────────┐
 │ Response: HTML page (200 OK)        │
 │ Content: Policy page with CSS/JS    │
 └─────────────────────────────────────┘
                  ↓
 Browser renders page
 Visitor reads policy
```

---

## File Dependency Map

```
                     Frontend Routes
                     ↓
    ┌────────────────┴────────────────┐
    ↓                                 ↓
SitePageController::show()      (default content)
    │                           privacy-policy.blade.php
    │                           terms.blade.php
    ↓                           disclaimer.blade.php
 SitePage Model                 refund-policy.blade.php
    │                           (KEPT as fallback)
    ↓
 Database: site_pages
    │
    └──→ pages/site-page.blade.php (render)
             │
             └──→ pages/layout.blade.php (layout)
                  │
                  └──→ layouts/landing.blade.php (structure)


                     Admin Routes
                     ↓
    ┌────────────────┴────────────────┐
    ↓                                 ↓
SitePageController (Admin)      Admin Middleware
    │                                 │
    ├─ index()                        └─→ admin.auth
    ├─ edit()
    ├─ update()
    └─ reset()
    │
    ├─→ SitePage Model
    │   │
    │   └─→ Database: site_pages
    │
    ├─→ admin/site-pages/list.blade.php
    │   │
    │   └─→ layouts/partials/admin/dashboard.blade.php
    │
    └─→ admin/site-pages/edit.blade.php
        │
        ├─→ layouts/partials/admin/dashboard.blade.php
        ├─→ Quill.js editor
        └─→ Quill CSS/JS assets
```

---

## Setup Checklist with Commands

```
[ ] Step 1: Database
    └─ php artisan migrate
       └─ Creates site_pages table

[ ] Step 2: Seed Initial Data
    └─ php artisan db:seed --class=SitePageSeeder
       └─ Inserts 4 policy pages with defaults

[ ] Step 3: Cache Clear (optional)
    └─ php artisan cache:clear
    └─ php artisan config:cache

[ ] Step 4: Test Admin Access
    └─ Log in to /admin
    └─ Navigate to Frontend → Site Pages
    └─ Should see list of 4 pages

[ ] Step 5: Test Edit
    └─ Click Edit on any page
    └─ Quill editor should load
    └─ Make small change
    └─ Click Save

[ ] Step 6: Verify Public Page
    └─ Visit /privacy-policy or other URL
    └─ Should see updated content
    └─ No code changes needed!

[ ] Step 7: Test Reset
    └─ Click Reset on a page
    └─ Confirm in modal
    └─ Content should revert to defaults
```

---

## Performance Metrics

```
Database Query:
  SELECT * FROM site_pages WHERE slug = ?
  Cost: ~1ms (index on slug)
  Result: Single row, returned immediately

Page Load (Frontend):
  1. Route match
  2. Controller dispatch
  3. Database query
  4. View render
  Total: ~50-100ms (same as before)

Page Load (Admin):
  1. Auth check
  2. Route match
  3. Controller dispatch
  4. Database query
  5. Quill.js load
  6. View render
  Total: ~100-200ms

Database Size Impact:
  per page: ~5-50KB (HTML content)
  4 pages: ~20-200KB total
  Negligible database overhead
```

---

## Key Points

1. **No Code Changes** – Admins edit in UI, not code
2. **Instant Publishing** – No caching between DB and view
3. **Same URLs** – Public URLs unchanged (`/privacy-policy`, etc.)
4. **Same Design** – Uses same `doc-card` CSS class
5. **Rich Editing** – Quill.js supports full HTML formatting
6. **Easy Reset** – One-click revert to defaults
7. **Transparent** – Users don't know it's from database
8. **Fallback** – Old static views still exist (not used)
9. **Secure** – Admin routes protected by middleware
10. **Extensible** – Can add multi-language, versioning, etc.
