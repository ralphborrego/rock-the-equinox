<?php
// Shared PDO connection. Include once per request.
$config = require __DIR__ . '/config.php';

try {
    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['name']};charset={$config['charset']}",
        $config['user'],
        $config['pass'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    exit('Database connection failed. Check includes/config.php / environment variables.');
}

function setting(PDO $pdo, string $key, string $default = ''): string {
    static $cache = [];
    if (!array_key_exists($key, $cache)) {
        $stmt = $pdo->prepare('SELECT `value` FROM settings WHERE `key` = ?');
        $stmt->execute([$key]);
        $cache[$key] = $stmt->fetchColumn() ?: $default;
    }
    return $cache[$key];
}

function e(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
