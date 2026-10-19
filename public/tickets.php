<?php
$pageTitle = 'Tickets';
require_once __DIR__ . '/../includes/header.php';
$tiers = $pdo->query("SELECT * FROM ticket_tiers ORDER BY sort_order ASC")->fetchAll();
$ticketUrl  = setting($pdo, 'ticket_url', '');
$eventDates = setting($pdo, 'event_dates', 'Dates TBA');
?>
<h1>Passes</h1>
<p class="muted"><?= e($eventDates) ?> &middot; <?= e(setting($pdo, 'venue', 'Stigler, OK')) ?></p>

<?php if ($tiers): ?>
<div class="tiers">
    <?php foreach ($tiers as $t): ?>
    <div class="tier<?= $t['featured'] ? ' featured' : '' ?>">
        <p class="tier-name"><?= e($t['name']) ?></p>
        <p class="tier-price"><?= e($t['price']) ?></p>
        <p class="muted"><?= nl2br(e($t['description'])) ?></p>
        <a class="btn<?= $t['featured'] ? ' btn-primary' : '' ?>" href="<?= e($t['url'] ?: $ticketUrl ?: '#') ?>">Get <?= e($t['name']) ?></a>
    </div>
    <?php endforeach; ?>
</div>
<?php elseif ($ticketUrl): ?>
    <p><a class="btn btn-primary" href="<?= e($ticketUrl) ?>">Buy Tickets</a></p>
    <p class="muted">Tickets are sold through our ticketing partner.</p>
<?php else: ?>
    <p class="muted">Passes aren't on sale yet — <a href="index.php?subscribed=1#">join the list</a> and you'll hear first.</p>
<?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
