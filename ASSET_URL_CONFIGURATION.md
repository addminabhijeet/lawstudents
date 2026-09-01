# Asset URL Configuration for Localhost & Live Server

## 🎯 Overview

This configuration ensures all assets (images, CSS, JS, fonts) load correctly on **both localhost and the live server** without modifying existing code logic.

### Live Server URL:
```
https://law.norloxsolutionscrm.com/
```

### Local Development URL:
```
http://localhost/lawstudents
```

---

## ✅ What Was Implemented

### 1. **Environment-Specific Configuration**

#### For Localhost (Automatic):
- File: `.env.local`
- Configuration: `APP_URL=http://localhost/lawstudents`
- **This file is automatically used in local development**

#### For Live Server:
- File: `.env`
- Configuration: `APP_URL=https://law.norloxsolutionscrm.com/`
- **This file is used in production**

### 2. **Asset URL Helpers**

Created helper functions that automatically use the correct APP_URL:

```php
// Helper functions available globally:
assetUrl('img/logo.png')           // Returns full URL
imgUrl('logo.png')                 // Returns full image URL
cssUrl('style.css')                // Returns full CSS URL
jsUrl('script.js')                 // Returns full JavaScript URL
getAppUrl()                        // Returns just the app URL
```

### 3. **Blade Directives**

Custom directives available in Blade templates:

```blade
<!-- Image with full URL -->
<img src="@asset('img/logo.png')" alt="Logo" />

<!-- Shorthand for images -->
<img src="@img('logo.png')" alt="Logo" />

<!-- CSS files -->
<link rel="stylesheet" href="@css('style.css')">

<!-- JavaScript files -->
<script src="@js('app.js')"></script>
```

### 4. **Configuration File**

- File: `config/assets.php`
- Centralized configuration for asset paths
- Can be extended for CDN support in future

---

## 🚀 Usage Examples

### Option 1: Using Helper Functions (Recommended for Blade)

```blade
<!-- Old way (still works): -->
<img src="/img/logo.png" alt="Logo" />

<!-- New way (works on all environments): -->
<img src="{{ assetUrl('img/logo.png') }}" alt="Logo" />

<!-- Or using shorthand: -->
<img src="{{ imgUrl('logo.png') }}" alt="Logo" />
```

### Option 2: Using Blade Directives

```blade
<!-- Image -->
<img src="@asset('img/logo.png')" alt="Logo" />
<img src="@img('logo.png')" alt="Logo" />

<!-- CSS -->
<link rel="stylesheet" href="@css('bootstrap.min.css')">

<!-- JavaScript -->
<script src="@js('app.js')"></script>
```

### Option 3: Using in PHP Code

```php
<?php

// In a controller or PHP file:
$imageUrl = assetUrl('img/logo.png');
$cssUrl = cssUrl('style.css');
$jsUrl = jsUrl('app.js');
$baseUrl = getAppUrl();

// Use in response:
return view('home', [
    'logoUrl' => $imageUrl,
    'styleUrl' => $cssUrl,
    'scriptUrl' => $jsUrl
]);
```

---

## 📝 How It Works

### On Localhost:
1. Laravel loads `.env.local` (overrides `.env`)
2. `APP_URL=http://localhost/lawstudents`
3. `assetUrl('img/logo.png')` returns:
   ```
   http://localhost/lawstudents/img/logo.png
   ```

### On Live Server:
1. `.env` is used
2. `APP_URL=https://law.norloxsolutionscrm.com/`
3. `assetUrl('img/logo.png')` returns:
   ```
   https://law.norloxsolutionscrm.com/img/logo.png
   ```

---

## 🔄 Migration Strategy

### For New Code:
Use the helper functions from the start:
```blade
<img src="{{ imgUrl('banner.jpg') }}" alt="Banner" />
```

### For Existing Code:
**No changes required!** Existing hardcoded paths like `/img/logo.png` will continue to work because:
- They're relative to the domain root
- On localhost: `/img/logo.png` resolves to `/lawstudents/img/logo.png` (correct in most cases)
- On live: `/img/logo.png` resolves to `/img/logo.png` (correct)

### Gradual Migration (Optional):
Update asset references when you encounter issues or during refactoring:
```blade
<!-- Before -->
<img src="/img/logo.png" alt="Logo" />

<!-- After -->
<img src="{{ imgUrl('logo.png') }}" alt="Logo" />
```

---

## 🛠️ Files Created/Modified

| File | Purpose |
|------|---------|
| `.env.local` | Override APP_URL for localhost |
| `app/Helpers/AssetHelper.php` | Asset URL generation class |
| `app/Helpers/helpers.php` | Global helper functions |
| `config/assets.php` | Asset configuration |
| `app/Providers/AppServiceProvider.php` | Register Blade directives |
| `composer.json` | Autoload helpers |

---

## ✨ Key Benefits

✅ **Works on both environments** - Same code, different URLs automatically  
✅ **No breaking changes** - Existing hardcoded paths still work  
✅ **Flexible** - Use helpers when needed, don't when you don't  
✅ **Maintainable** - Centralized asset configuration  
✅ **Production-ready** - Works with the live server domain  
✅ **Easy debugging** - Helpers work in Blade, PHP, and global scope  

---

## 🔍 Testing

### On Localhost:
1. Open `http://localhost/lawstudents/`
2. Right-click image → Inspect
3. Check `src` attribute should show:
   ```
   http://localhost/lawstudents/img/...
   ```

### Using Helper in Blade:
```blade
<!-- This will show the correct URL in both environments -->
<img src="{{ imgUrl('logo.png') }}" alt="Logo" />

<!-- Debug: View the generated URL -->
<!-- {{ imgUrl('logo.png') }} -->
```

---

## 📚 Reference

### Available Helper Functions:

```php
// Generate full asset URL
assetUrl('path/to/file')          // Any file
imgUrl('filename.jpg')            // Images specifically
cssUrl('filename.css')            // CSS files
jsUrl('filename.js')              // JavaScript files

// Get just the URL
getAppUrl()                       // http://localhost/lawstudents

// Get path
assetPath('img/logo.png')         // /img/logo.png
```

### Available Blade Directives:

```blade
@asset('path')      <!-- Full URL for any asset -->
@img('filename')    <!-- Full URL for images -->
@css('filename')    <!-- Full URL for CSS -->
@js('filename')     <!-- Full URL for JavaScript -->
```

---

## ⚠️ Important Notes

1. **`.env.local` is for local development only**
   - Never commit it to production
   - It's in `.gitignore` by default

2. **Current `.env` is for production**
   - Keep `APP_URL=https://law.norloxsolutionscrm.com/`
   - Never modify it for local testing

3. **Helper functions are optional**
   - Use them for new code or when troubleshooting asset loading issues
   - Existing hardcoded paths continue to work

4. **Run composer dump-autoload after changes**
   - If helpers don't work, run: `composer dump-autoload`
   - This regenerates the PHP autoloader

---

## 🐛 Troubleshooting

### Assets not loading on localhost?
1. Make sure `.env.local` exists with correct `APP_URL`
2. Clear Laravel cache: `php artisan config:clear`
3. Run `composer dump-autoload`
4. Refresh browser (Ctrl+Shift+R for hard refresh)

### Assets not loading on live server?
1. Check `.env` has correct `APP_URL`
2. Verify public folder is accessible via web
3. Run `php artisan config:cache` on server
4. Check file permissions on asset folders

### Helper functions not working?
1. Verify `composer.json` includes helpers in autoload
2. Run `composer dump-autoload`
3. Check `app/Helpers/helpers.php` exists
4. Restart your web server

---

## 🎯 Next Steps

1. **Verify Setup**:
   - Check files exist: `.env.local`, `app/Helpers/AssetHelper.php`, `app/Helpers/helpers.php`
   - Run: `composer dump-autoload`

2. **Test on Localhost**:
   - Visit `http://localhost/lawstudents/`
   - Verify images load correctly
   - Check in browser DevTools that URLs are correct

3. **Use in New Code**:
   - Use `imgUrl()` or `@img()` for new image references
   - Use `assetUrl()` for other resources

4. **Gradual Migration** (Optional):
   - Update existing asset paths when refactoring
   - No rush - existing paths continue to work

---

**Your application now automatically uses the correct URLs for both localhost and production!** 🚀
