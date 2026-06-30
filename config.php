<?php
// ============================================
// LOAD ENVIRONMENT VARIABLES
// Create a .env file in the same directory with your settings
// ============================================

$envPath = __DIR__ . '/.env';
if (file_exists($envPath)) {
    $envLines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($envLines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        // Parse KEY=VALUE
        if (strpos($line, '=') !== false) {
            $parts = explode('=', $line, 2);
            $key = trim($parts[0]);
            $value = trim($parts[1] ?? '');
            // Remove surrounding quotes if present
            $value = preg_replace('/^[' . "'\"" . '](.*)[' . "'\"" . ']$/', '$1', $value);
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

// ============================================
// DATABASE CONFIGURATION
// Set these in your .env file or environment variables
// ============================================

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'guide');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: 'root');

define('SITE_NAME', getenv('SITE_NAME') ?: 'MNFST Studio');
define('SITE_URL', getenv('SITE_URL') ?: 'http://localhost');
define('UPLOAD_DIR', __DIR__ . '/uploads/');
define('UPLOAD_URL', SITE_URL . '/uploads/');

// Admin session name
define('SESSION_NAME', getenv('SESSION_NAME') ?: 'mnfst_admin_session');

// Error reporting (set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    return $pdo;
}