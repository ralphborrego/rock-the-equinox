<?php
$pageTitle = 'Home';
require_once __DIR__ . '/../includes/header.php';

$eventDates = setting($pdo, 'event_dates', 'Dates TBA');
$venue      = setting($pdo, 'venue', 'Stigler, OK');
$ticketUrl  = setting($pdo, 'ticket_url', '');

$headliners = $pdo->query(
    "SELECT * FROM artists ORDER BY sort_order ASC, name ASC LIMIT 4"
)->fetchAll();
?>

<section class="hero">
    <h1><?= e(setting($pdo, 'site_name', 'Rock the Equinox')) ?></h1>
    <p class="hero-sub"><?= e($tagline) ?></p>
    <p class="hero-meta"><?= e($eventDates) ?> &middot; <?= e($venue) ?></p>
    <div class="hero-actions">
        <?php if ($ticketUrl): ?>
            <a class="btn btn-primary" href="<?= e($ticketUrl) ?>">Get Tickets</a>
        <?php endif; ?>
        <a class="btn" href="lineup.php">See the Lineup</a>
    </div>
</section>

<section>
    <h2>Featured Artists</h2>
    <div class="cards">
        <?php foreach ($headliners as $a): ?>
        <article class="card">
            <?php if ($a['image_url']): ?>
                <img src="<?= e($a['image_url']) ?>" alt="<?= e($a['name']) ?>">
            <?php endif; ?>
            <h3><?= e($a['name']) ?></h3>
            <p class="muted"><?= e($a['genre']) ?> &middot; <?= e($a['stage']) ?></p>
        </article>
        <?php endforeach; ?>
        <?php if (!$headliners): ?><p class="muted">Lineup announcements coming soon.</p><?php endif; ?>
    </div>
</section>

<section class="cta-band">
    <h2>Want to play, vend, or sponsor?</h2>
    <p>We're a community-run festival and we'd love to hear from you.</p>
    <a class="btn btn-primary" href="contact.php">Get in Touch</a>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
