<?php
require_once __DIR__ . '/db.php';
$siteName = setting($pdo, 'site_name', 'Rock the Equinox');
$tagline  = setting($pdo, 'tagline', '');
$ticketUrl = setting($pdo, 'ticket_url', '');
$pageTitle = ($pageTitle ?? $siteName) . ' | ' . $siteName;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pageTitle) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Barlow+Condensed:wght@600;700&family=Barlow:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="wrap">
        <a class="brand" href="index.php">
            <span class="brand-mark" aria-hidden="true">RTE</span>
            <span>
            <span class="brand-name"><?= e($siteName) ?></span>
            <?php if ($tagline): ?><span class="brand-tag"><?= e($tagline) ?></span><?php endif; ?>
            </span>
        </a>
        <nav class="main-nav">
            <a href="lineup.php">Lineup</a>
            <a href="schedule.php">Schedule</a>
            <a href="vendors.php">Vendors</a>
            <a href="sponsors.php">Sponsors</a>
            <a href="faq.php">FAQ</a>
            <a href="contact.php">Contact</a>
            <a class="nav-cta" href="tickets.php">Get Tickets</a>
        </nav>
    </div>
</header>
<main class="wrap">
