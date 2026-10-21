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
$allArtists = $pdo->query("SELECT name FROM artists ORDER BY sort_order ASC, name ASC")->fetchAll(PDO::FETCH_COLUMN);
$sponsors = $pdo->query("SELECT * FROM sponsors ORDER BY sort_order ASC, name ASC")->fetchAll();
$majorSponsors = [];
$otherSponsors = [];
foreach ($sponsors as $s) {
    if (strcasecmp($s['tier'], 'Major') === 0) { $majorSponsors[] = $s; }
    else { $otherSponsors[] = $s; }
}
?>
</main>

<section class="hero">
    <div class="hero-inner">
        <p class="hero-kicker">Lake John Wells &middot; Stigler, Oklahoma</p>
        <h1 class="hero-title" aria-label="<?= e($siteName) ?>">
            <span class="t-rock">Rock</span>
            <span class="t-the">The</span>
            <span class="t-nox">Equinox</span>
        </h1>
        <p class="hero-sub"><?= e($tagline) ?>. Two days of Oklahoma loud on the lake — free, all ages, and wide open.</p>
        <p class="hero-meta"><?= e($eventDates) ?> &middot; <?= e($venue) ?></p>
        <div class="badges">
            <span class="badge b1">Free Admission</span>
            <span class="badge b2">All Ages</span>
            <span class="badge b3">20 Bands &middot; 2 Days</span>
            <span class="badge b4">Lakeside Camping</span>
        </div>
        <div class="hero-actions">
            <a class="btn btn-primary" href="lineup.php">See the Lineup</a>
            <a class="btn" href="schedule.php">Set Times</a>
            <a class="btn" href="tickets.php">Get Tickets</a>
        </div>
    </div>
</section>

<?php if ($allArtists): ?>
<div class="marquee m1" aria-hidden="true">
    <div class="marquee-track">
        <?php for ($r = 0; $r < 2; $r++): foreach ($allArtists as $n): ?>
        <span><?= e($n) ?></span><i>///</i>
        <?php endforeach; endfor; ?>
    </div>
</div>
<div class="marquee m2" aria-hidden="true">
    <div class="marquee-track">
        <?php for ($r = 0; $r < 2; $r++): foreach (array_reverse($allArtists) as $n): ?>
        <span><?= e($n) ?></span><i>///</i>
        <?php endforeach; endfor; ?>
    </div>
</div>
<?php endif; ?>

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

<section class="block">
    <div class="section-head"><h2>XI by the numbers</h2></div>
    <div class="stats">
        <div class="stat"><span class="stat-num">20</span><span class="stat-lbl">Bands</span></div>
        <div class="stat"><span class="stat-num">2</span><span class="stat-lbl">Days</span></div>
        <div class="stat"><span class="stat-num">$0</span><span class="stat-lbl">Admission</span></div>
        <div class="stat"><span class="stat-num">1</span><span class="stat-lbl">Lake</span></div>
    </div>
</section>

<?php if ($sponsors): ?>
<section class="block">
    <div class="section-head"><h2>Our Sponsors</h2><a href="sponsors.php">All sponsors &rarr;</a></div>
    <?php if ($majorSponsors): ?>
    <div class="sponsor-majors">
        <?php foreach ($majorSponsors as $s): ?>
        <article class="sponsor-major">
            <?php if ($s['website']): ?><a href="<?= e($s['website']) ?>" target="_blank" rel="noopener"><?php endif; ?>
                <?php if ($s['logo_url']): ?><img src="<?= e($s['logo_url']) ?>" alt="<?= e($s['name']) ?>"><?php endif; ?>
                <span class="sponsor-name"><?= e($s['name']) ?></span>
            <?php if ($s['website']): ?></a><?php endif; ?>
        </article>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?php if ($otherSponsors): ?>
    <p class="sponsor-names">
        <?php foreach ($otherSponsors as $i => $s): ?>
        <?php if ($i): ?><span class="sep">///</span><?php endif; ?>
        <?php if ($s['website']): ?><a href="<?= e($s['website']) ?>" target="_blank" rel="noopener"><?= e($s['name']) ?></a><?php else: ?><?= e($s['name']) ?><?php endif; ?>
        <?php endforeach; ?>
    </p>
    <?php endif; ?>
</section>
<?php endif; ?>

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
