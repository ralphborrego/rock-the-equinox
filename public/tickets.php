<?php
$pageTitle = 'Tickets';
require_once __DIR__ . '/../includes/header.php';
$ticketUrl  = setting($pdo, 'ticket_url', '');
$eventDates = setting($pdo, 'event_dates', 'Dates TBA');
?>
<h1>Tickets</h1>
<p><?= e($eventDates) ?> &middot; <?= e(setting($pdo, 'venue', 'Stigler, OK')) ?></p>
<?php if ($ticketUrl): ?>
    <p><a class="btn btn-primary" href="<?= e($ticketUrl) ?>">Buy Tickets</a></p>
    <p class="muted">Tickets are sold through our ticketing partner.</p>
<?php else: ?>
    <p class="muted">Ticket sales aren't open yet — check back soon or <a href="contact.php">contact us</a>.</p>
<?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
