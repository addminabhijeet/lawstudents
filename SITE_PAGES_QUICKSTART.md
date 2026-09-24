# Site Pages – Quick Start

## TL;DR

Your policy pages are now **fully editable from the admin panel**. No code changes needed.

---

## 30-Second Setup

```bash
# 1. Run migration (creates database table)
php artisan migrate

# 2. Seed default data (populates 4 policy pages)
php artisan db:seed --class=SitePageSeeder

# 3. Done! Log in to admin and go to: Frontend → Site Pages
```

---

## Using the Admin Panel

### To Edit a Policy:

1. **Log in** to admin panel
2. Go to **Frontend** → **Site Pages**
3. Click **Edit** on the policy you want to change
4. Use the text editor to modify content
5. Click **Save Changes**
6. Done! The change is live immediately on the public site

### To Reset a Policy to Default:

1. On the **Site Pages** list
2. Click **Reset** button
3. Confirm in the popup
4. Policy reverts to original template

---

## What Changed?

### Before
```
Routes: /privacy-policy → static views/pages/privacy-policy.blade.php
Content: Hardcoded in PHP files
Editing: Modify code, redeploy
```

### After
```
Routes: /privacy-policy → dynamic database (same URL!)
Content: Stored in site_pages table
Editing: Admin panel UI + Quill editor
```

**Public URLs stay the same** – visitors see no difference.

---

## Policy Pages Included

All four policies are pre-loaded with template text that you should customize:

1. **Privacy Policy** (`/privacy-policy`)
   - Data collection & usage
   - User rights
   - Contact info

2. **Terms & Conditions** (`/terms-and-conditions`)
   - User eligibility
   - Course usage rights
   - Payment & refunds
   - Governing law

3. **Disclaimer** (`/disclaimer`)
   - Educational content only
   - Not legal advice
   - External links
   - Accuracy notices

4. **Refund Policy** (`/refund-policy`)
   - Refund windows
   - Refund conditions
   - Cancellation policies
   - Request process

---

## Editor Features

Use the **Quill Rich Text Editor** to:

- ✏️ **Bold, italic, underline** text
- 📝 **Headings** (H1–H6)
- 🔗 **Links** to other pages or documents
- 📋 **Lists** (bullets & numbers)
- 💾 **Blockquotes** for important notices
- 🎨 **Color text** and backgrounds
- ↔️ **Alignment** (left, center, right)
- 🧹 **Clean** formatting with one click

---

## What's Not Changed?

✅ Frontend page design (same `doc-card` styling)  
✅ Public URLs (all links still work)  
✅ Admin sidebar structure  
✅ Student/login systems  
✅ Any other functionality  

Only **policy editing** is now dynamic.

---

## Files You Need to Know About

| File | Purpose |
|------|---------|
| `app/Http/Controllers/Admin/SitePageController.php` | Handles admin edits |
| `app/Http/Controllers/Frontend/SitePageController.php` | Displays pages |
| `app/Models/SitePage.php` | Database model |
| `resources/views/admin/site-pages/edit.blade.php` | Admin editor |
| `resources/views/pages/site-page.blade.php` | Frontend display |
| `database/migrations/2026_09_24_000001_create_site_pages_table.php` | Database table |
| `database/seeders/SitePageSeeder.php` | Initial data |

---

## Common Tasks

### Change the Refund Period
1. Go to **Admin** → **Frontend** → **Site Pages**
2. Click **Edit** on "Refund Policy"
3. Find the text "7 days" and change to your period
4. Click **Save Changes**
5. Live immediately

### Add Your Email/Phone
1. Edit any policy
2. Find the placeholder contact details
3. Replace with real info
4. Save

### Use Your Company Name
Search/replace "Law Students" in each policy with your actual company name.

---

## Troubleshooting

**Q: Admin list page shows "No pages found"**  
A: Run the seeder: `php artisan db:seed --class=SitePageSeeder`

**Q: Editor looks broken**  
A: Clear cache: `php artisan cache:clear`

**Q: Changes aren't showing on the public site**  
A: Wait 30 seconds (in case there's caching), then refresh

**Q: I accidentally deleted all content**  
A: Click **Reset** to restore the default template instantly

---

## Before Going Live

⚠️ **Before using these policies on production:**

1. Review all four policies (Privacy, Terms, Disclaimer, Refund)
2. **Have a lawyer review them** – these are legal documents
3. Customize with your actual:
   - Company name
   - Email address
   - Phone number
   - Refund periods/terms
   - Data practices
4. Remove all placeholder text like "*Sample policy*"

---

## Questions?

See `SITE_PAGES_SETUP.md` for full documentation, or check the controller files for implementation details.

**Key Routes:**
- Admin List: `/admin/site-pages`
- Admin Edit: `/admin/site-pages-edit/{id}`
- Frontend: `/privacy-policy`, `/terms-and-conditions`, `/disclaimer`, `/refund-policy`
