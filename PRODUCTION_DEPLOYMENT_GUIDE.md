# Production Deployment Guide - API Documentation Fix

## Problem Summary
Production was showing OLD API documentation (only categories and rate-requests) because:
1. ✅ **Scribe was picking up legacy routes** with doc block annotations
2. ✅ **.scribe cache directory** contained old endpoint definitions
3. ✅ **Legacy controllers** had `@group` and method annotations that Scribe processed

## What Was Fixed

### 1. Updated Scribe Configuration
**File:** `config/scribe.php`

Added explicit exclusions for all legacy API routes:
```php
'exclude' => [
    'api/rate-requests*',
    'api/categories/*',
    'api/about',
    'api/clients',
    'api/services',
    // ... all legacy routes excluded
],
```

### 2. Cleared Documentation Cache
- Deleted `.scribe/` directory (contains cached endpoint definitions)
- Regenerated fresh documentation with only V1 routes

### 3. Fixed Resource Classes
All Resource classes now match actual database schema (previously had wrong field names causing nulls).

## Production Deployment Steps

### Step 1: Deploy Code
```bash
# Pull latest code
git pull origin main
```

### Step 2: Clear Caches (IMPORTANT!)
```bash
# Clear all Laravel caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Regenerate optimized files
php artisan config:cache
php artisan route:cache
composer dump-autoload
```

### Step 3: Delete Old Documentation Cache
```bash
# Remove old cached documentation
rm -rf .scribe
rm -rf storage/app/scribe/*
```

### Step 4: Regenerate Documentation
```bash
# Generate fresh documentation with ONLY V1 routes
php artisan scribe:generate --force
```

### Step 5: Verify
Visit `/docs` on your production domain to confirm you see:
- ✅ 28 V1 API endpoints (not just 2)
- ✅ All organized into groups (Home, About Us, Services, Events, Blog, etc.)
- ✅ No legacy routes shown

## Expected Result

Your `/docs` should now show **11 groups** with **28 total endpoints**:

| Group | Endpoints |
|-------|-----------|
| Home | 1 |
| About Us | 1 |
| Services | 3 |
| Events | 2 |
| Blog | 3 |
| Pricing | 1 |
| Reviews | 3 |
| Training | 2 |
| Static Content | 5 |
| Rate Requests | 3 |
| Categories | 4 |

## Files Changed

### Core Changes
- ✅ `config/scribe.php` - Added legacy route exclusions
- ✅ All Resource classes - Fixed to match database schema
- ✅ `routes/api.php` - Added V1 routes (legacy routes preserved)

### New Files
- 11 new V1 API Controllers
- 15 new Resource classes
- `API_README.md` - Comprehensive documentation
- `API_QUICK_REFERENCE.md` - Quick reference guide

## Troubleshooting

### If Documentation Still Shows Old Routes

1. **Check if .scribe exists:**
```bash
ls -la .scribe
```
If it exists, delete it:
```bash
rm -rf .scribe
```

2. **Verify Scribe config:**
```bash
php artisan config:cache
grep -A 20 "'exclude'" config/scribe.php
```

3. **Clear ALL caches:**
```bash
php artisan optimize:clear
composer dump-autoload
```

4. **Regenerate docs:**
```bash
php artisan scribe:generate --force
```

### If Still Not Working

The browser might be caching the old docs. Try:
- Hard refresh (Ctrl+Shift+R or Cmd+Shift+R)
- Clear browser cache
- Open in incognito/private window

## Important Notes

### ✅ Legacy Routes Preserved
All old API routes (`/api/rate-requests`, `/api/categories/*`, etc.) **still work**. They're just excluded from documentation.

### ✅ No Breaking Changes
- Existing mobile app (if any) using legacy routes will continue working
- New mobile app should use `/api/v1/*` routes
- Both can coexist until legacy migration is complete

### ✅ Documentation URLs
- Interactive: `/docs`
- Postman: `/docs.postman`
- OpenAPI: `/docs.openapi`

## Support

If documentation still shows old routes after following all steps:

1. Check web server configuration (Nginx/Apache)
2. Ensure `.scribe` directory is writable
3. Check `storage/app/scribe/` permissions
4. Verify Scribe is version 5.3.0 or higher

---

**Last Updated:** October 30, 2025  
**Scribe Version:** 5.3.0  
**Laravel Version:** Check `composer.json`

