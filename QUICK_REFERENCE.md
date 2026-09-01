# 🚀 Quick Reference - Asset URLs for All Environments

## ⚡ TL;DR (Too Long; Didn't Read)

Your app now **automatically uses the correct URLs** on both localhost and production!

---

## 🎯 What to Use in Blade Templates

### For Images:
```blade
<!-- Use this: -->
<img src="{{ imgUrl('logo.png') }}" alt="Logo" />

<!-- Or this: -->
<img src="@img('logo.png')" alt="Logo" />
```

### For CSS:
```blade
<link rel="stylesheet" href="{{ cssUrl('style.css') }}">
<!-- Or: <link rel="stylesheet" href="@css('style.css')"> -->
```

### For JavaScript:
```blade
<script src="{{ jsUrl('app.js') }}"></script>
<!-- Or: <script src="@js('app.js')"></script> -->
```

### For Any Asset:
```blade
<a href="{{ assetUrl('docs/guide.pdf') }}">Download</a>
<!-- Or: <a href="@asset('docs/guide.pdf')">Download</a> -->
```

---

## 🔄 How It Works (Simple)

### Localhost:
```
Your code: {{ imgUrl('banner.jpg') }}
↓
.env.local: APP_URL=http://localhost/lawstudents
↓
Result: http://localhost/lawstudents/img/banner.jpg ✅
```

### Live Server:
```
Your code: {{ imgUrl('banner.jpg') }}
↓
.env: APP_URL=https://law.norloxsolutionscrm.com/
↓
Result: https://law.norloxsolutionscrm.com/img/banner.jpg ✅
```

---

## 📋 Quick Setup Checklist

- [ ] Files exist: `.env.local`, `app/Helpers/AssetHelper.php`, `app/Helpers/helpers.php`
- [ ] Run: `composer dump-autoload`
- [ ] Clear cache: `php artisan config:clear`
- [ ] Test: Visit `http://localhost/lawstudents/`
- [ ] Inspect image in browser → URL should show: `http://localhost/lawstudents/img/...`

---

## 🎮 Available Functions

```php
// In Blade or PHP:
assetUrl('path')        // Full URL for any file
imgUrl('file.jpg')      // Full URL for image
cssUrl('file.css')      // Full URL for CSS  
jsUrl('file.js')        // Full URL for JS
getAppUrl()             // Just the base URL
```

---

## 🎭 Available Directives

```blade
@asset('path')          <!-- Full URL for any file -->
@img('file.jpg')        <!-- Full URL for image -->
@css('file.css')        <!-- Full URL for CSS -->
@js('file.js')          <!-- Full URL for JS -->
```

---

## 🔒 Important Files

| What | File | Why |
|------|------|-----|
| Localhost config | `.env.local` | Overrides APP_URL for local dev |
| Live config | `.env` | Uses production domain |
| Helpers | `app/Helpers/` | Generate correct URLs |
| Config | `config/assets.php` | Asset path settings |

---

## ✅ That's It!

### Use in New Code:
```blade
<img src="{{ imgUrl('new-image.jpg') }}" />
```

### Existing Code:
Still works! `/img/logo.png` continues to work as-is.

### Results:
✅ Localhost: Works  
✅ Live Server: Works  
✅ No configuration per environment  
✅ No code changes to existing views needed  

---

## 🆘 If Something Breaks

```bash
# Regenerate autoloader
composer dump-autoload

# Clear all caches
php artisan config:clear
php artisan view:clear

# Hard refresh browser
Ctrl+Shift+R (or Cmd+Shift+R on Mac)
```

---

## 📚 Full Documentation

- **Setup Guide**: `ASSET_URL_SETUP_COMPLETE.md`
- **Complete Docs**: `ASSET_URL_CONFIGURATION.md`
- **Code Examples**: `resources/views/partials/asset-examples.blade.php`

---

**That's all you need to know! Your assets are now configured for both environments.** 🎉
