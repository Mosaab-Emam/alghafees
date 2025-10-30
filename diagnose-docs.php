#!/usr/bin/env php
<?php

/**
 * Documentation CSS Diagnostic Script
 * 
 * Run this in production to diagnose why CSS isn't loading:
 * php diagnose-docs.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "\n";
echo "=================================================\n";
echo "   ALGHAFIS API DOCS - DIAGNOSTIC REPORT\n";
echo "=================================================\n\n";

// 1. Check APP_URL
echo "1. APP_URL Configuration\n";
echo "   ------------------------\n";
$appUrl = config('app.url');
echo "   APP_URL: " . $appUrl . "\n";
if ($appUrl === 'http://localhost' || $appUrl === 'http://localhost:8000') {
    echo "   ⚠️  WARNING: APP_URL is set to localhost!\n";
    echo "   📝 Fix: Set APP_URL in .env to your production domain\n";
} else {
    echo "   ✅ APP_URL looks correct\n";
}
echo "\n";

// 2. Check asset URL generation
echo "2. Asset URL Generation\n";
echo "   ------------------------\n";
$cssUrl = asset('vendor/scribe/css/theme-default.style.css');
$jsUrl = asset('vendor/scribe/js/theme-default-5.3.0.js');
echo "   CSS URL: " . $cssUrl . "\n";
echo "   JS URL:  " . $jsUrl . "\n\n";

// 3. Check if files exist
echo "3. Asset Files Existence\n";
echo "   ------------------------\n";
$publicPath = public_path();
$cssFile = $publicPath . '/vendor/scribe/css/theme-default.style.css';
$jsFile = $publicPath . '/vendor/scribe/js/theme-default-5.3.0.js';

if (file_exists($cssFile)) {
    echo "   ✅ CSS file exists: " . $cssFile . "\n";
    echo "      Size: " . round(filesize($cssFile) / 1024, 2) . " KB\n";
    echo "      Perms: " . substr(sprintf('%o', fileperms($cssFile)), -4) . "\n";
} else {
    echo "   ❌ CSS file NOT FOUND: " . $cssFile . "\n";
    echo "   📝 Fix: Run 'php artisan scribe:generate --force'\n";
}

if (file_exists($jsFile)) {
    echo "   ✅ JS file exists: " . $jsFile . "\n";
    echo "      Size: " . round(filesize($jsFile) / 1024, 2) . " KB\n";
    echo "      Perms: " . substr(sprintf('%o', fileperms($jsFile)), -4) . "\n";
} else {
    echo "   ❌ JS file NOT FOUND: " . $jsFile . "\n";
    echo "   📝 Fix: Run 'php artisan scribe:generate --force'\n";
}
echo "\n";

// 4. Check view file
echo "4. Blade View File\n";
echo "   ------------------------\n";
$viewFile = resource_path('views/scribe/index.blade.php');
if (file_exists($viewFile)) {
    echo "   ✅ View file exists\n";
    
    $content = file_get_contents($viewFile);
    
    // Check if using asset() helper
    if (strpos($content, "{{ asset('vendor/scribe/css/theme-default.style.css') }}") !== false) {
        echo "   ✅ View uses asset() helper correctly\n";
    } elseif (strpos($content, 'scribe/css/theme-default.style.css') !== false) {
        echo "   ❌ View uses RELATIVE paths (broken!)\n";
        echo "   📝 Fix: Update view to use {{ asset() }} helper\n";
    } else {
        echo "   ⚠️  Cannot determine asset path format\n";
    }
} else {
    echo "   ❌ View file NOT FOUND\n";
    echo "   📝 Fix: Run 'php artisan scribe:generate --force'\n";
}
echo "\n";

// 5. Check cache
echo "5. Cache Status\n";
echo "   ------------------------\n";
$configCached = file_exists(base_path('bootstrap/cache/config.php'));
$routesCached = file_exists(base_path('bootstrap/cache/routes-v7.php'));
$viewsCached = is_dir(storage_path('framework/views')) && count(glob(storage_path('framework/views/*.php'))) > 0;

echo "   Config cached: " . ($configCached ? "✅ Yes" : "❌ No") . "\n";
echo "   Routes cached: " . ($routesCached ? "✅ Yes" : "❌ No") . "\n";
echo "   Views cached:  " . ($viewsCached ? "⚠️  Yes (may need clearing)" : "✅ No") . "\n";

if ($viewsCached) {
    echo "\n   📝 Run: php artisan view:clear\n";
}
echo "\n";

// 6. Test HTTP access (if curl available)
echo "6. HTTP Accessibility Test\n";
echo "   ------------------------\n";
if (function_exists('curl_init')) {
    $ch = curl_init($cssUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        echo "   ✅ CSS file accessible via HTTP (Status: 200)\n";
    } elseif ($httpCode === 404) {
        echo "   ❌ CSS file returns 404 Not Found\n";
        echo "   📝 Check web server configuration\n";
    } elseif ($httpCode === 403) {
        echo "   ❌ CSS file returns 403 Forbidden\n";
        echo "   📝 Check file permissions and web server config\n";
    } elseif ($httpCode === 0) {
        echo "   ⚠️  Could not connect (might be firewall/local network)\n";
    } else {
        echo "   ⚠️  Unexpected HTTP status: " . $httpCode . "\n";
    }
} else {
    echo "   ⚠️  cURL not available, skipping HTTP test\n";
}
echo "\n";

// 7. Environment info
echo "7. Environment Information\n";
echo "   ------------------------\n";
echo "   Laravel:  " . app()->version() . "\n";
echo "   PHP:      " . PHP_VERSION . "\n";
echo "   OS:       " . PHP_OS . "\n";
echo "   ENV:      " . app()->environment() . "\n";
echo "\n";

// Summary and recommendations
echo "=================================================\n";
echo "   SUMMARY & RECOMMENDED ACTIONS\n";
echo "=================================================\n\n";

$issues = [];

if ($appUrl === 'http://localhost' || $appUrl === 'http://localhost:8000') {
    $issues[] = "1. Set APP_URL in .env to your production domain";
    $issues[] = "   Then run: php artisan config:cache";
}

if (!file_exists($cssFile) || !file_exists($jsFile)) {
    $issues[] = "2. Regenerate Scribe documentation:";
    $issues[] = "   php artisan scribe:generate --force";
}

if ($viewsCached) {
    $issues[] = "3. Clear view cache:";
    $issues[] = "   php artisan view:clear";
}

if (empty($issues)) {
    echo "✅ No obvious issues detected!\n\n";
    echo "If CSS still doesn't load:\n";
    echo "- Check browser console for errors (F12)\n";
    echo "- Try hard refresh (Cmd+Shift+R or Ctrl+Shift+R)\n";
    echo "- Check web server error logs\n";
    echo "- Verify Nginx/Apache allows /vendor directory\n";
} else {
    echo "Found " . count($issues) . " issue(s) to fix:\n\n";
    foreach ($issues as $issue) {
        echo $issue . "\n";
    }
}

echo "\n";
echo "For more help, see: PRODUCTION_TROUBLESHOOTING.md\n";
echo "\n";

