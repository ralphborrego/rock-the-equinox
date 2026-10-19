<?php
// Database credentials — set via environment variables, never hardcode secrets.
// Local dev (Termux): export DB_HOST=127.0.0.1 DB_NAME=equinox DB_USER=root DB_PASS=""
// GoDaddy cPanel: use the DB name/user/password you create in cPanel.
return [
    'host' => getenv('DB_HOST') ?: '127.0.0.1',
    'name' => getenv('DB_NAME') ?: 'equinox',
    'user' => getenv('DB_USER') ?: 'root',
    'pass' => getenv('DB_PASS') ?: '',
    'charset' => 'utf8mb4',
];
