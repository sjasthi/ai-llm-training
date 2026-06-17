<?php
// ============================================================
// AI Training n Impact Tracker — Configuration Template
// ============================================================
// Copy this file to config.php and fill in your details.

// ---- Application ----
define('APP_NAME',    'AI Training n Impact Tracker');
define('APP_VERSION', '1.0.0');

// Dynamic base URL (auto-detects path from document root — portable across deployments)
$scheme   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
$_docRoot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? ''), '/');
$appPath  = str_replace($_docRoot, '', str_replace('\\', '/', __DIR__));

define('APP_URL', $scheme . '://' . $host . $appPath);

// ---- Database ----
define('JASPER_DB_KEY', 'jasper_db');

// ---- File Uploads ----
define('UPLOAD_MAX_SIZE', 50 * 1024 * 1024); // 50 MB
define('UPLOAD_DIR',      __DIR__ . '/assets/materials/');
define('UPLOAD_URL',      APP_URL . '/assets/materials/');
