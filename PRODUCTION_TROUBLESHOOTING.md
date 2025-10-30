# Production Documentation CSS Not Loading - Troubleshooting Guide

## Quick Checklist

Run these commands in production to diagnose the issue:

```bash
# 1. Check if assets exist
ls -la public/vendor/scribe/css/
ls -la public/vendor/scribe/js/

# 2. Check APP_URL is set correctly
php artisan tinker
>>> config('app.url')
>>> exit

# 3. Check if view cache is cleared
php artisan view:clear

# 4. Test asset URL generation
php artisan tinker
>>> asset('vendor/scribe/css/theme-default.style.css')
>>> exit
```

## Common Issues & Solutions

### Issue 1: Assets Don't Exist in public/vendor/scribe

**Symptom:** `ls -la public/vendor/scribe/` shows "No such file or directory"

**Cause:** Scribe assets weren't published after regenerating docs

**Solution:**
```bash
cd /path/to/your/project

# Regenerate documentation (this republishes assets)
php artisan scribe:generate --force

# Verify assets exist
ls -la public/vendor/scribe/
```

You should see:
```
drwxr-xr-x  css/
drwxr-xr-x  images/
drwxr-xr-x  js/
```

---

### Issue 2: Wrong APP_URL in Production

**Symptom:** Browser network tab shows 404 for CSS files OR CSS URLs point to wrong domain

**Cause:** `APP_URL` in `.env` is set to `http://localhost`

**Solution:**
```bash
# Edit .env file
nano .env

# Change this line to your production URL:
APP_URL=https://your-production-domain.com

# Clear and recache config
php artisan config:clear
php artisan config:cache
```

**Verify:**
```bash
php artisan tinker
>>> config('app.url')
# Should output: "https://your-production-domain.com"
```

---

### Issue 3: View Cache Not Cleared

**Symptom:** Still showing old broken paths after deploy

**Cause:** Blade views are cached with old asset paths

**Solution:**
```bash
# Clear view cache
php artisan view:clear

# Optionally clear all caches
php artisan optimize:clear

# Hard refresh browser (Cmd+Shift+R or Ctrl+Shift+R)
```

---

### Issue 4: Web Server Not Serving /vendor Directory

**Symptom:** CSS files return 404 even though files exist

**Cause:** Nginx/Apache configuration blocking `/vendor` directory

**Solution for Nginx:**

Check your Nginx config (`/etc/nginx/sites-available/your-site`):

```nginx
server {
    # ... other config ...
    
    root /path/to/your/project/public;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    # Ensure vendor directory is accessible
    location ~ ^/vendor/ {
        try_files $uri =404;
    }
    
    # ... other config ...
}
```

After changing config:
```bash
sudo nginx -t
sudo systemctl reload nginx
```

**Solution for Apache:**

Check `.htaccess` in `public/` directory:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Allow vendor directory
    RewriteCond %{REQUEST_URI} ^/vendor/
    RewriteRule ^ - [L]
    
    # ... rest of rules ...
</IfModule>
```

---

### Issue 5: File Permissions

**Symptom:** 403 Forbidden on CSS files

**Cause:** Wrong file permissions

**Solution:**
```bash
# Fix permissions
chmod -R 755 public/vendor/scribe
chown -R www-data:www-data public/vendor/scribe  # Ubuntu/Debian
# OR
chown -R nginx:nginx public/vendor/scribe  # CentOS/RHEL

# Verify
ls -la public/vendor/scribe/
```

---

### Issue 6: Cached Old HTML in Browser

**Symptom:** View source shows old relative paths, not {{ asset() }}

**Cause:** Browser cached the old HTML page

**Solution:**
1. Hard refresh: `Cmd+Shift+R` (Mac) or `Ctrl+Shift+R` (Windows/Linux)
2. Clear browser cache completely
3. Open in incognito/private window
4. Try different browser

---

### Issue 7: CDN/Cloudflare Caching

**Symptom:** Works in incognito but not in normal browser

**Cause:** CDN is serving cached old version

**Solution:**

**For Cloudflare:**
1. Log into Cloudflare dashboard
2. Go to your domain
3. Caching → Purge Everything
4. Wait 2-3 minutes
5. Hard refresh browser

**For other CDNs:**
- Check your CDN dashboard for cache purge options
- Temporarily bypass CDN by accessing server IP directly

---

## Verification Steps

After fixing, verify everything works:

### 1. Check Asset URLs in HTML

Visit `/docs` and view page source (`Cmd+U` or `Ctrl+U`):

**Look for these lines:**
```html
<link rel="stylesheet" href="https://your-domain.com/vendor/scribe/css/theme-default.style.css">
<script src="https://your-domain.com/vendor/scribe/js/theme-default-5.3.0.js"></script>
```

**Should NOT see:**
```html
<!-- WRONG - relative paths -->
<link rel="stylesheet" href="scribe/css/theme-default.style.css">
```

### 2. Test Asset URLs Directly

Open these URLs in browser:
```
https://your-domain.com/vendor/scribe/css/theme-default.style.css
https://your-domain.com/vendor/scribe/js/theme-default-5.3.0.js
```

Should see CSS/JS code, not 404 or error page.

### 3. Check Browser Console

Open browser DevTools (F12), go to Console tab. Should see NO errors like:
- `Failed to load resource: net::ERR_ABORTED 404`
- `Failed to load stylesheet`

### 4. Check Network Tab

In DevTools → Network tab:
- Reload page
- Look for `theme-default.style.css`
- Status should be `200` (not 404, 403, or 500)
- Type should be `stylesheet`

---

## Advanced Debugging

### Generate Test Route

Add to `routes/web.php` temporarily:

```php
Route::get('/test-assets', function() {
    return [
        'asset_url' => asset('vendor/scribe/css/theme-default.style.css'),
        'app_url' => config('app.url'),
        'file_exists' => file_exists(public_path('vendor/scribe/css/theme-default.style.css')),
    ];
});
```

Visit `/test-assets` to see:
```json
{
  "asset_url": "https://your-domain.com/vendor/scribe/css/theme-default.style.css",
  "app_url": "https://your-domain.com",
  "file_exists": true
}
```

### Check PHP-FPM/Web Server Logs

**Nginx:**
```bash
tail -f /var/log/nginx/error.log
tail -f /var/log/nginx/access.log
```

**Apache:**
```bash
tail -f /var/log/apache2/error.log
tail -f /var/log/apache2/access.log
```

**PHP-FPM:**
```bash
tail -f /var/log/php-fpm/www-error.log
```

---

## Nuclear Option: Complete Reset

If nothing else works:

```bash
# 1. Delete everything docs-related
rm -rf .scribe
rm -rf storage/app/scribe
rm -rf public/vendor/scribe
rm -rf resources/views/scribe

# 2. Clear all caches
php artisan optimize:clear
php artisan view:clear
php artisan config:clear
php artisan route:clear
php artisan cache:clear

# 3. Verify APP_URL is correct
echo "APP_URL in .env:"
grep APP_URL .env
php artisan tinker --execute="echo config('app.url');"

# 4. Regenerate documentation
php artisan scribe:generate --force

# 5. Verify assets exist
ls -la public/vendor/scribe/css/

# 6. Recache config
php artisan config:cache
php artisan route:cache

# 7. Test direct CSS URL
curl -I https://your-domain.com/vendor/scribe/css/theme-default.style.css
# Should return: HTTP/1.1 200 OK

# 8. Hard refresh browser
```

---

## Still Not Working?

### Compare with Local

Run these commands on BOTH local and production:

```bash
echo "=== APP_URL ==="
php artisan tinker --execute="echo config('app.url');"

echo "=== Asset Path ==="
php artisan tinker --execute="echo asset('vendor/scribe/css/theme-default.style.css');"

echo "=== File Exists ==="
ls -la public/vendor/scribe/css/theme-default.style.css

echo "=== First 10 lines of view ==="
head -20 resources/views/scribe/index.blade.php | grep asset
```

Compare the outputs to find differences.

---

## Contact Information

If you've tried everything above and it still doesn't work:

1. **Check Laravel logs:** `storage/logs/laravel.log`
2. **Check web server error logs**
3. **Verify PHP version:** `php -v` (should be 8.1+)
4. **Check disk space:** `df -h`

Provide this information when seeking help:
- Laravel version: `php artisan --version`
- PHP version: `php -v`
- Web server: Nginx/Apache + version
- Operating system
- Output of all commands above

