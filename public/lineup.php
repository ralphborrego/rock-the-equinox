<?php
$pageTitle = 'Lineup';
require_once __DIR__ . '/../includes/header.php';
$artists = $pdo->query("SELECT * FROM artists ORDER BY sort_order ASC, name ASC")->fetchAll();
?>
<h1>Lineup</h1>
<div class="cards">
<?php foreach ($artists as $a): ?>
<article class="card">
    <?php if ($a['image_url']): ?><img src="<?= e($a['image_url']) ?>" alt="<?= e($a['name']) ?>"><?php endif; ?>
    <h3><?= e($a['name']) ?></h3>
    <p class="muted"><?= e($a['genre']) ?> &middot; <?= e($a['stage']) ?></p>
    <?php if ($a['bio']): ?><p><?= nl2br(e($a['bio'])) ?></p><?php endif; ?>
</article>
<?php endforeach; ?>
</div>
<?php if (!$artists): ?><p class="muted">Lineup announcements coming soon.</p><?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
