<?php
require_once __DIR__ . '/auth.php';
$unread = $pdo->query('SELECT COUNT(*) FROM messages WHERE is_read = 0')->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard | Rock the Equinox</title>
<link rel="stylesheet" href="../public/assets/css/style.css"></head>
<body><main class="wrap" style="padding-top:2rem">
<h1>Board Dashboard</h1>
<p><a href="../public/index.php">View site</a> &middot; <a href="logout.php">Log out</a></p>
<ul>
    <li><a href="artists.php">Manage lineup</a></li>
    <li><a href="schedule_admin.php">Manage schedule</a></li>
    <li><a href="ticket_tiers.php">Manage ticket tiers</a></li>
    <li><a href="faqs.php">Manage FAQs</a></li>
    <li><a href="messages.php">Contact messages<?= $unread ? " ($unread unread)" : '' ?></a></li>
    <li><a href="subscribers.php">Newsletter subscribers</a></li>
    <li><a href="settings.php">Site settings (dates, tickets, venue)</a></li>
</ul>
<p class="muted">Vendors and sponsors are managed directly in the database for now.</p>
</main></body></html>
