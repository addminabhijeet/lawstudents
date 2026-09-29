# Site Pages – Deployment Checklist

Use this checklist before deploying to production.

---

## Pre-Deployment (Development Environment)

- [ ] **Code Review**
  - [ ] Review all 5 new controller methods
  - [ ] Review admin views (list & edit)
  - [ ] Review frontend view (site-page)
  - [ ] Review routes (admin & web)
  - [ ] Check sidebar modification

- [ ] **Database Setup**
  - [ ] Migration file created: `database/migrations/2026_09_24_000001_create_site_pages_table.php`
  - [ ] Seeder file created: `database/seeders/SitePageSeeder.php`
  - [ ] Run migration locally: `php artisan migrate`
  - [ ] Run seeder locally: `php artisan db:seed --class=SitePageSeeder`
  - [ ] Verify 4 rows in `site_pages` table

- [ ] **Admin Panel Testing**
  - [ ] Log in as admin
  - [ ] Navigate to Frontend → Site Pages
  - [ ] See list of 4 pages
  - [ ] Click Edit on each page
  - [ ] Quill editor loads without errors
  - [ ] Make a test change to one page
  - [ ] Click Save Changes
  - [ ] See success message
  - [ ] Page appears updated in list

- [ ] **Public Page Testing**
  - [ ] Visit `/privacy-policy`
  - [ ] Visit `/terms-and-conditions`
  - [ ] Visit `/disclaimer`
  - [ ] Visit `/refund-policy`
  - [ ] All pages load without errors
  - [ ] All pages show dynamic content from DB
  - [ ] Test change from admin is visible on public
  - [ ] Page design is identical to original
  - [ ] All links work

- [ ] **Reset Functionality**
  - [ ] Click Reset on a test page
  - [ ] Confirm modal appears
  - [ ] Click confirm
  - [ ] Page content reverts to defaults
  - [ ] Success message appears

---

## Content Preparation

- [ ] **Privacy Policy**
  - [ ] Read default template
  - [ ] Remove "*Sample policy*" warning
  - [ ] Verify company name
  - [ ] Verify email address
  - [ ] Verify phone number
  - [ ] Check address
  - [ ] Have legal team review
  - [ ] Make any customizations
  - [ ] Test in admin editor
  - [ ] Save

- [ ] **Terms & Conditions**
  - [ ] Read default template
  - [ ] Remove "*Sample terms*" warning
  - [ ] Verify company name
  - [ ] Verify all policies match your practices
  - [ ] Have legal team review
  - [ ] Make any customizations
  - [ ] Test in admin editor
  - [ ] Save

- [ ] **Disclaimer**
  - [ ] Read default template
  - [ ] Remove "*Sample disclaimer*" warning
  - [ ] Verify it matches your business model
  - [ ] Have legal team review
  - [ ] Make any customizations
  - [ ] Test in admin editor
  - [ ] Save

- [ ] **Refund Policy**
  - [ ] Read default template
  - [ ] Remove "*Sample policy*" warning
  - [ ] Verify refund period (replace "7 days" if needed)
  - [ ] Verify usage limit (replace "20%" if needed)
  - [ ] Verify email address
  - [ ] Verify phone number
  - [ ] Verify processing time (replace "7-10 days" if needed)
  - [ ] Have legal team review
  - [ ] Make any customizations
  - [ ] Test in admin editor
  - [ ] Save

---

## Staging Environment

- [ ] **Database Deployment**
  - [ ] Git pull latest code
  - [ ] Run migration: `php artisan migrate`
  - [ ] Run seeder: `php artisan db:seed --class=SitePageSeeder`
  - [ ] Verify 4 rows in database: `SELECT COUNT(*) FROM site_pages;`

- [ ] **Admin Panel**
  - [ ] Log in to admin
  - [ ] Navigate to Frontend → Site Pages
  - [ ] See list of 4 pages
  - [ ] Try editing one page
  - [ ] Verify Quill editor works
  - [ ] Save and verify

- [ ] **Public Pages**
  - [ ] Visit all 4 policy URLs
  - [ ] Verify content loads from database
  - [ ] Verify design is correct
  - [ ] Test on mobile (responsive)
  - [ ] Test on different browsers
  - [ ] Verify all links work

- [ ] **Admin Features**
  - [ ] Test reset functionality
  - [ ] Test pagination (if >10 pages)
  - [ ] Test on mobile (admin can edit on phone)
  - [ ] Verify success/error messages

- [ ] **Performance**
  - [ ] Measure page load time (should be <200ms)
  - [ ] Check database size (should be <1MB)
  - [ ] Monitor server logs for errors
  - [ ] No console errors in browser

---

## Production Deployment

- [ ] **Backup**
  - [ ] Database backup before deploying
  - [ ] Code backup (git branch)
  - [ ] Document rollback procedure

- [ ] **Code Deployment**
  - [ ] Commit message clear and descriptive
  - [ ] All files included: controllers, models, migrations, views
  - [ ] Push to production branch
  - [ ] Verify CI/CD passes (if applicable)

- [ ] **Database Deployment**
  - [ ] Run migration on production: `php artisan migrate --force`
  - [ ] Run seeder: `php artisan db:seed --class=SitePageSeeder`
  - [ ] Verify data in production database

- [ ] **Cache Clearing**
  - [ ] Clear cache: `php artisan cache:clear`
  - [ ] Clear config: `php artisan config:cache`
  - [ ] Clear view cache: `php artisan view:clear`

- [ ] **Smoke Testing**
  - [ ] Log in to production admin
  - [ ] Navigate to Frontend → Site Pages
  - [ ] Edit one page (test change)
  - [ ] Save
  - [ ] Visit public page
  - [ ] Verify change appears
  - [ ] Reset page (verify reverts)
  - [ ] Visit all 4 policy URLs
  - [ ] Verify all display correctly

- [ ] **Final Checks**
  - [ ] Check server logs for errors
  - [ ] Monitor database performance
  - [ ] Test admin on different browsers
  - [ ] Test public pages on mobile
  - [ ] Verify no JavaScript errors
  - [ ] Check email contact links work
  - [ ] Verify all links are 200 OK (no 404s)

---

## Post-Deployment

- [ ] **Monitoring**
  - [ ] Monitor error logs for 24 hours
  - [ ] Watch admin panel usage
  - [ ] Check page load times
  - [ ] Monitor database performance

- [ ] **Documentation**
  - [ ] Update internal wiki/docs
  - [ ] Notify team members (staff can now edit policies)
  - [ ] Create admin training guide if needed
  - [ ] Keep backup of deployment notes

- [ ] **Backup Admin Access**
  - [ ] Verify admin accounts still work
  - [ ] Ensure backup admin can access Site Pages
  - [ ] Document admin credentials securely

---

## Rollback Procedure (If Needed)

If critical issues occur:

1. **Revert Code**
   ```bash
   git revert <commit-hash>
   git push
   ```

2. **Rollback Database** (if migration caused issues)
   ```bash
   php artisan migrate:rollback --force
   ```

3. **Restore from Backup**
   ```bash
   # Restore database from pre-deployment backup
   # Verify all data restored
   ```

4. **Clear Caches**
   ```bash
   php artisan cache:clear
   php artisan config:cache
   ```

5. **Verify Rollback**
   - Check admin still works
   - Check public pages still work
   - Check error logs

6. **Document Issues**
   - Note what went wrong
   - What was the fix
   - How to prevent in future

---

## Common Issues & Fixes

### Issue: 404 on `/admin/site-pages`
**Causes:**
- Migration not run
- Routes not reloaded
- Middleware issue

**Fix:**
- Run `php artisan migrate`
- Restart PHP-FPM: `systemctl restart php-fpm`
- Check `routes/admin.php` has routes

### Issue: Quill editor blank in admin
**Causes:**
- Assets not loading
- JavaScript error
- Blade variable not passed

**Fix:**
- Clear cache: `php artisan cache:clear`
- Check browser console for errors
- Verify Quill files at `public/assets/vendors/`

### Issue: Changes don't show on public
**Causes:**
- Cache not cleared
- Page not saved properly
- Database connection issue

**Fix:**
- Clear cache: `php artisan cache:clear`
- Check database has updated row
- Verify page slug matches URL

### Issue: Reset button doesn't work
**Causes:**
- Modal JavaScript not loading
- Controller method issue
- Form not submitting

**Fix:**
- Check browser console
- Verify Bootstrap is loaded
- Check `routes/admin.php` for reset route

---

## Sign-Off

- [ ] **Development Lead**
  - Name: _______________
  - Date: _______________
  - Sign-off: Tested locally, ready for staging

- [ ] **Staging Lead**
  - Name: _______________
  - Date: _______________
  - Sign-off: Tested on staging, ready for production

- [ ] **Production Deployer**
  - Name: _______________
  - Date: _______________
  - Sign-off: Deployed to production, monitoring

---

## Documentation Links

- Admin guide: `SITE_PAGES_QUICKSTART.md`
- Setup guide: `SITE_PAGES_SETUP.md`
- Architecture: `IMPLEMENTATION_SUMMARY.md`
- Troubleshooting: `SITE_PAGES_SETUP.md` → Troubleshooting section
- Reference: `SITE_PAGES_REFERENCE.md`

---

## Success Criteria

✅ All 4 policy pages load from database  
✅ Admin can edit pages without errors  
✅ Changes appear instantly on public site  
✅ Reset to defaults works  
✅ No console errors  
✅ Page load time <200ms  
✅ Admin panel responsive on mobile  
✅ Public pages render correctly  
✅ All links work  
✅ Legal content reviewed & approved  

**If all criteria met, deployment successful!** 🎉
