<?php
// Database connection.
// Credentials are read from environment variables when set; otherwise the
// local XAMPP defaults are used (change them for any real deployment).

if (!class_exists('EdocDB')) {
    class EdocDB extends mysqli
    {
        // Escape a value for use inside a single-quoted SQL string literal.
        public function esc($value)
        {
            return $this->real_escape_string((string) $value);
        }

        // Force a value to an integer for use in a numeric SQL context.
        public function int($value)
        {
            return (int) $value;
        }
    }
}

$db_host = getenv('EDOC_DB_HOST') ?: 'localhost';
$db_user = getenv('EDOC_DB_USER') ?: 'root';
$db_pass = getenv('EDOC_DB_PASS') ?: '';
$db_name = getenv('EDOC_DB_NAME') ?: 'edoc';

$database = new EdocDB($db_host, $db_user, $db_pass, $db_name);
if ($database->connect_error) {
    error_log('Database connection failed: ' . $database->connect_error);
    die('Database connection failed. Please try again later.');
}
$database->set_charset('utf8mb4');

// Escape a value for safe output inside HTML (text and attributes).
if (!function_exists('h')) {
    function h($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}
