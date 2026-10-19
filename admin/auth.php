<?php
// Admin session guard — include at the top of every admin page except index.php/login.
session_start();
if (empty($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}
require_once __DIR__ . '/../includes/db.php';
