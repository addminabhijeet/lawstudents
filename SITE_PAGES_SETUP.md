# Dynamic Site Pages Implementation

## Overview

This implementation makes all policy pages (Privacy Policy, Terms & Conditions, Disclaimer, Refund Policy) **fully dynamic and editable from the admin panel** without modifying the code logic.

## Features

✅ **Admin Panel Editor** – Rich text editor (Quill) for editing policy content  
✅ **Database Storage** – All page content stored in `site_pages` table  
✅ **Reset to Defaults** – One-click reset to original template content  
✅ **Dynamic Routes** – Frontend automatically fetches content from database  
✅ **No Code Changes Required** – Policies update instantly without code deployment  
✅ **Consistent Styling** – Pages render with the same `doc-card` layout as before  

---

## Database Schema

### `site_pages` Table

```sql
CREATE TABLE site_pages (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    slug VARCHAR(255) UNIQUE NOT NULL,        -- privacy-policy, terms-and-conditions, etc.
    title VARCHAR(255) NOT NULL,              -- Page title (Privacy Policy, etc.)
    content LONGTEXT NOT NULL,                -- HTML content (from Quill editor)
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Initial Data

Four pages are auto-populated by the seeder:
- `privacy-policy` → Privacy Policy
- `terms-and-conditions` → Terms & Conditions
- `disclaimer` → Disclaimer
- `refund-policy` → Refund Policy

---

## Admin Panel Access

### Location in Dashboard
**Admin Panel** → **Frontend** → **Site Pages**

### Admin Routes

| Route | Method | Purpose |
|-------|--------|---------|
| `/admin/site-pages` | GET | List all pages |
| `/admin/site-pages-edit/{id}` | GET | Edit form for a page |
| `/admin/site-pages-update/{id}` | POST | Save page changes |
| `/admin/site-pages-reset/{id}` | POST | Reset to default content |

---

## How to Use

### 1. List Pages
Navigate to **Admin Panel** → **Frontend** → **Site Pages**

You'll see all four policy pages with their last update time.

### 2. Edit a Page
- Click the **Edit** button next to any page
- Use the **Quill Rich Text Editor** to modify content:
  - **Headings** (H1–H6)
  - **Bold, Italic, Underline, Strikethrough**
  - **Lists** (ordered and unordered)
  - **Blockquotes & Code Blocks**
  - **Links** and **Images**
  - **Color & Background**
  - **Alignment**
  - **Clean formatting**
- Click **Save Changes** to publish immediately

### 3. Reset to Defaults
- Click the **Reset** button next to any page
- Confirm the action
- Page reverts to original template text
- Useful if you accidentally delete important content

---

## Frontend Pages

### URL Mapping

| URL | Slug | Title |
|-----|------|-------|
| `/privacy-policy` | `privacy-policy` | Privacy Policy |
| `/terms-and-conditions` | `terms-and-conditions` | Terms & Conditions |
| `/disclaimer` | `disclaimer` | Disclaimer |
| `/refund-policy` | `refund-policy` | Refund Policy |

All pages:
- Render with the same **`doc-card` layout** as the original static pages
- Display the content exactly as edited in the admin panel
- Load dynamically from the database (zero caching issues)

---

## Files Modified/Created

### New Files

1. **Database**
   - `database/migrations/2026_09_24_000001_create_site_pages_table.php` – Creates table

2. **Models**
   - `app/Models/SitePage.php` – ORM model for site pages

3. **Controllers**
   - `app/Http/Controllers/Admin/SitePageController.php` – Admin CRUD operations
   - `app/Http/Controllers/Frontend/SitePageController.php` – Frontend page display

4. **Views**
   - `resources/views/admin/site-pages/list.blade.php` – Admin list view
   - `resources/views/admin/site-pages/edit.blade.php` – Admin edit form (Quill editor)
   - `resources/views/pages/site-page.blade.php` – Frontend page display

5. **Seeders**
   - `database/seeders/SitePageSeeder.php` – Populates initial data

### Modified Files

1. **Routes**
   - `routes/admin.php` – Added site page routes
   - `routes/web.php` – Changed static `Route::view()` to dynamic controller

2. **Views**
   - `resources/views/layouts/partials/admin/dashboard.blade.php` – Added "Site Pages" to sidebar

---

## Installation & Setup

### 1. Run Migration
```bash
php artisan migrate
```

This creates the `site_pages` table.

### 2. Seed Default Data
```bash
php artisan db:seed --class=SitePageSeeder
```

This populates the four policy pages with default template content.

### 3. Clear Cache (if applicable)
```bash
php artisan cache:clear
php artisan config:cache
```

### 4. Test
1. Log in to admin panel
2. Navigate to **Frontend** → **Site Pages**
3. Click **Edit** on any page
4. Make a small change and save
5. Visit the public page (e.g., `/privacy-policy`) to verify the change appears

---

## Quill Editor Features

The Quill editor in the admin panel includes:

**Formatting**
- Headers (H1 through H6)
- Bold, Italic, Underline, Strikethrough
- Text and background colors

**Blocks**
- Bullet lists
- Numbered lists
- Blockquotes
- Code blocks

**Advanced**
- Links
- Hyperlink insertion
- Alignment (left, center, right, justify)
- Indentation
- Clean formatting button

---

## Default Content

Each page includes default template text that admins should customize:

### Privacy Policy
- Information collection practices
- Data usage policies
- Sharing and retention terms
- Security measures
- User rights

### Terms & Conditions
- User eligibility
- Account responsibilities
- Course usage rights
- Payment and refund policies
- Acceptable use guidelines
- Governing law

### Disclaimer
- Educational purpose only
- No legal advice
- Not a Bar Council solicitation
- Accuracy of legal texts
- Exam information disclaimer
- External links disclaimer

### Refund Policy
- Free material (no refund)
- Refund windows (7 days, 20% usage limit)
- Non-refundable scenarios
- Batch cancellations
- Refund request process
- Processing timeline

---

## Database Queries

### Get All Pages
```php
$pages = SitePage::all();
```

### Get One Page by Slug
```php
$page = SitePage::where('slug', 'privacy-policy')->first();
```

### Get One Page by ID
```php
$page = SitePage::find($id);
```

### Update Page
```php
$page->update([
    'title' => 'New Title',
    'content' => '<p>New content</p>',
    'last_updated' => now(),
]);
```

---

## Advanced Customization

### Add a New Policy Page

If you need to add a fifth page (e.g., "Cookie Policy"):

1. **Add to Seeder** (`database/seeders/SitePageSeeder.php`):
```php
[
    'slug' => 'cookie-policy',
    'title' => 'Cookie Policy',
    'content' => $this->getCookiePolicyContent(),
],
```

2. **Add Route** (`routes/web.php`):
```php
Route::get('cookie-policy', [SitePageController::class, 'show'])
    ->defaults('slug', 'cookie-policy')
    ->name('cookies');
```

3. **Run Seeder**:
```bash
php artisan db:seed --class=SitePageSeeder
```

### Change Editor Settings

Edit `resources/views/admin/site-pages/edit.blade.php` to modify Quill options:
```javascript
const quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
        toolbar: [
            // Add/remove toolbar options here
        ]
    }
});
```

---

## Troubleshooting

### Pages Not Showing in Admin
1. Verify migration ran: `php artisan migrate:status`
2. Check database: `SELECT COUNT(*) FROM site_pages;`
3. Clear cache: `php artisan cache:clear`

### Frontend Page Shows 404
1. Verify page exists in database
2. Check slug spelling matches exactly (case-sensitive)
3. Ensure route is registered in `routes/web.php`

### Editor Not Loading
1. Verify Quill CSS/JS are loading: check browser console
2. Quill files should be at: `public/assets/vendors/css/quill.min.css` and `public/assets/vendors/js/quill.min.js`
3. Clear browser cache

### Content Not Saving
1. Check form validation errors on admin page
2. Verify content field is not empty
3. Check Laravel logs: `storage/logs/laravel.log`

---

## Testing Checklist

- [ ] Migration created `site_pages` table
- [ ] Seeder populated 4 pages in database
- [ ] Admin list view shows all pages
- [ ] Can edit each page from admin panel
- [ ] Quill editor initializes without errors
- [ ] Page saves successfully and shows success message
- [ ] Reset button works and restores default content
- [ ] Frontend pages display dynamic content from database
- [ ] All four URLs work: `/privacy-policy`, `/terms-and-conditions`, `/disclaimer`, `/refund-policy`
- [ ] Static views (old .blade.php files) no longer used
- [ ] No code changes required for policy updates

---

## Security Notes

- **Admin Access**: Site Pages are only editable by authenticated admins (middleware: `admin.auth`)
- **HTML Content**: Content is stored and displayed as raw HTML (allows admins to embed custom formatting)
- **No XSS Protection**: Since admins control the content, no additional escaping is applied
- **Backup**: Always backup the database before making policy changes

---

## Performance

- **Database Queries**: One query per page view (cached after first request if Laravel caching is enabled)
- **Editor Load**: Quill.js ~30KB (already available in public assets)
- **Page Render**: Same performance as static views (slightly faster due to single template)

---

## Future Enhancements

Consider adding:
1. **Revision History** – Track past versions of pages
2. **Publish Scheduling** – Schedule policy updates to go live at specific times
3. **Language Support** – Multi-language policy pages
4. **Audit Trail** – Log who changed what and when
5. **Preview Mode** – Preview changes before publishing
6. **Email Notifications** – Notify users of policy changes

---

## Questions?

Refer to the implementation files for detailed documentation:
- `app/Http/Controllers/Admin/SitePageController.php` – Admin controller logic
- `app/Models/SitePage.php` – Database model
- `database/migrations/2026_09_24_000001_create_site_pages_table.php` – Database schema
