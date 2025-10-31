<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

/**
 * index_hostinger.php
 *
 * A resilient front controller for Hostinger deployments.
 * It searches a few parent locations for `vendor/autoload.php` and
 * `bootstrap/app.php` so this file can work when the `public` contents
 * are placed directly in `public_html/` or when the project root is one
 * level above.
 */

define('LARAVEL_START', microtime(true));

// helper to find a file up to N levels above
function find_up($filename, $maxLevels = 4)
{
    $dir = __DIR__;
    for ($i = 0; $i <= $maxLevels; $i++) {
        $path = $dir . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($path)) {
            return $path;
        }
        $dir = dirname($dir);
    }
    return false;
}

// maintenance check (mirror of default index.php)
$maintenance = find_up('storage/framework/maintenance.php', 3);
if ($maintenance && file_exists($maintenance)) {
    require $maintenance;
}

// Try to locate Composer autoload
$autoload = find_up('vendor/autoload.php', 3);
if (! $autoload) {
    // fallback to original relative path
    $autoload = __DIR__ . '/../vendor/autoload.php';
}

if (! file_exists($autoload)) {
    http_response_code(500);
    echo "Autoloader not found. Did you upload vendor/ or run composer install? (tried: " . htmlspecialchars($autoload) . ")";
    exit(1);
}

require $autoload;

// Bootstrap the application
$bootstrap = find_up('bootstrap/app.php', 3);
if (! $bootstrap) {
    $bootstrap = __DIR__ . '/../bootstrap/app.php';
}

if (! file_exists($bootstrap)) {
    http_response_code(500);
    echo "Bootstrap file not found. Check deployment layout. (tried: " . htmlspecialchars($bootstrap) . ")";
    exit(1);
}

/** @var Application $app */
$app = require_once $bootstrap;

$app->handleRequest(Request::capture());

// EOF
