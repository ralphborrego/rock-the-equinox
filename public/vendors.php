<?php
$pageTitle = 'Vendors';
require_once __DIR__ . '/../includes/header.php';
$vendors = $pdo->query("SELECT * FROM vendors WHERE approved = 1 ORDER BY name ASC")->fetchAll();
?>
<h1>Vendors</h1>
<div class="cards">
<?php foreach ($vendors as $v): ?>
<article class="card">
    <h3><?= e($v['name']) ?></h3>
    <p class="muted"><?= e($v['type']) ?></p>
    <?php if ($v['description']): ?><p><?= nl2br(e($v['description'])) ?></p><?php endif; ?>
    <?php if ($v['website']): ?><p><a href="<?= e($v['website']) ?>">Website</a></p><?php endif; ?>
</article>
<?php endforeach; ?>
</div>
<?php if (!$vendors): ?><p class="muted">Vendor announcements coming soon.</p><?php endif; ?>
<section class="cta-band">
    <h2>Want to vend at the festival?</h2>
    <p><a class="btn" href="contact.php">Contact the board</a> about vendor applications.</p>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
