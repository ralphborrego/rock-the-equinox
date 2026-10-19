<?php
$pageTitle = 'Home';
require_once __DIR__ . '/../includes/header.php';

$eventDates = setting($pdo, 'event_dates', 'Dates TBA');
$eventStart = setting($pdo, 'event_start', '');
$venue      = setting($pdo, 'venue', 'Stigler, OK');
$ticketUrl  = setting($pdo, 'ticket_url', '');

$headliners = $pdo->query(
    "SELECT * FROM artists WHERE tier = 'Headliner' ORDER BY sort_order ASC, name ASC LIMIT 3"
)->fetchAll();
$tiers = $pdo->query("SELECT * FROM ticket_tiers ORDER BY sort_order ASC LIMIT 3")->fetchAll();
$faqs = $pdo->query("SELECT * FROM faqs ORDER BY sort_order ASC LIMIT 4")->fetchAll();
?>
</main>

<section class="hero">
    <p class="hero-kicker">Stigler, Oklahoma</p>
    <h1><?= e($siteName) ?></h1>
    <p class="hero-sub"><?= e($tagline) ?></p>
    <p class="hero-meta"><?= e($eventDates) ?> &middot; <?= e($venue) ?></p>
    <div class="hero-actions">
        <a class="btn btn-primary" href="tickets.php">Get Tickets</a>
        <a class="btn" href="lineup.php">Explore the Lineup</a>
    </div>
</section>

<div class="countdown-band">
    <p class="countdown-label" id="countdown-label">The gates open in</p>
    <div class="countdown" id="countdown" data-event-start="<?= e($eventStart) ?>"></div>
</div>
<script src="assets/js/countdown.js"></script>

<main class="wrap">
<section class="block">
    <div class="section-head"><h2>Headliners</h2><a href="lineup.php">Full lineup &rarr;</a></div>
    <div class="headliners">
        <?php foreach ($headliners as $a): ?>
        <article class="headliner">
            <?php if ($a['image_url']): ?><img src="<?= e($a['image_url']) ?>" alt="<?= e($a['name']) ?>"><?php endif; ?>
            <div class="hl-body">
                <p class="genre"><?= e($a['genre']) ?></p>
                <h3><?= e($a['name']) ?></h3>
            </div>
        </article>
        <?php endforeach; ?>
        <?php if (!$headliners): ?><p class="muted">Headliner announcements coming soon.</p><?php endif; ?>
    </div>
</section>

<?php if ($tiers): ?>
<section class="block">
    <div class="section-head"><h2>Passes</h2><a href="tickets.php">All passes &rarr;</a></div>
    <div class="tiers">
        <?php foreach ($tiers as $t): ?>
        <div class="tier<?= $t['featured'] ? ' featured' : '' ?>">
            <p class="tier-name"><?= e($t['name']) ?></p>
            <p class="tier-price"><?= e($t['price']) ?></p>
            <p class="muted"><?= nl2br(e($t['description'])) ?></p>
            <a class="btn<?= $t['featured'] ? ' btn-primary' : '' ?>" href="<?= e($t['url'] ?: $ticketUrl ?: 'tickets.php') ?>">Get <?= e($t['name']) ?></a>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<?php if ($faqs): ?>
<section class="block">
    <div class="section-head"><h2>Questions? We've got answers.</h2><a href="faq.php">All FAQs &rarr;</a></div>
    <?php foreach ($faqs as $f): ?>
    <div class="faq-item">
        <h3><?= e($f['question']) ?></h3>
        <p><?= nl2br(e($f['answer'])) ?></p>
    </div>
    <?php endforeach; ?>
</section>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
