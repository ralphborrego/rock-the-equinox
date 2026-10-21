<?php
$pageTitle = 'Lineup';
require_once __DIR__ . '/../includes/header.php';
$headliners = $pdo->query(
    "SELECT * FROM artists WHERE tier = 'Headliner' ORDER BY sort_order ASC, name ASC"
)->fetchAll();
$support = $pdo->query(
    "SELECT * FROM artists WHERE tier != 'Headliner' ORDER BY sort_order ASC, name ASC"
)->fetchAll();
$slotByArtist = [];
foreach ($pdo->query("SELECT artist_id, day, start_time FROM schedule_slots")->fetchAll() as $s) {
    $slotByArtist[$s['artist_id']] = $s;
}
?>
<h1>Lineup</h1>

<?php if ($headliners): ?>
<h2>Headliners</h2>
<div class="headliners" style="margin-bottom:2.5rem">
    <?php foreach ($headliners as $a): ?>
    <article class="headliner">
        <?php if ($a['image_url']): ?><img src="<?= e($a['image_url']) ?>" alt="<?= e($a['name']) ?>"><?php endif; ?>
        <div class="hl-body">
            <p class="genre"><?= e($a['genre']) ?></p>
            <h3><?= e($a['name']) ?></h3>
            <?php if (isset($slotByArtist[$a['id']])): $s = $slotByArtist[$a['id']]; ?>
            <p class="slot-chip"><?= e($s['day']) ?> &middot; <?= e(date('g:i A', strtotime($s['start_time']))) ?></p>
            <?php endif; ?>
            <?php if ($a['bio']): ?><p class="muted"><?= nl2br(e($a['bio'])) ?></p><?php endif; ?>
        </div>
    </article>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<h2>Full Lineup</h2>
<div class="cards">
<?php foreach (array_merge($headliners, $support) as $a): ?>
<article class="card">
    <?php if ($a['image_url']): ?><img src="<?= e($a['image_url']) ?>" alt="<?= e($a['name']) ?>"><?php endif; ?>
    <h3><?= e($a['name']) ?></h3>
    <p class="muted"><?= e($a['genre']) ?> &middot; <?= e($a['stage']) ?></p>
    <?php if (isset($slotByArtist[$a['id']])): $s = $slotByArtist[$a['id']]; ?>
    <p class="slot-chip"><?= e($s['day']) ?> &middot; <?= e(date('g:i A', strtotime($s['start_time']))) ?></p>
    <?php endif; ?>
    <?php if ($a['bio']): ?><p><?= nl2br(e($a['bio'])) ?></p><?php endif; ?>
</article>
<?php endforeach; ?>
</div>
<?php if (!$headliners && !$support): ?><p class="muted">Lineup announcements coming soon.</p><?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
