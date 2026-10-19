<?php
$pageTitle = 'Sponsors';
require_once __DIR__ . '/../includes/header.php';
$sponsors = $pdo->query("SELECT * FROM sponsors ORDER BY sort_order ASC, name ASC")->fetchAll();
$tiers = [];
foreach ($sponsors as $s) { $tiers[$s['tier']][] = $s; }
?>
<h1>Sponsors</h1>
<p>Rock the Equinox is community-powered. Thank you to our sponsors.</p>
<?php foreach ($tiers as $tier => $list): ?>
<h2><?= e($tier) ?></h2>
<div class="cards">
<?php foreach ($list as $s): ?>
<article class="card">
    <?php if ($s['logo_url']): ?><img src="<?= e($s['logo_url']) ?>" alt="<?= e($s['name']) ?>"><?php endif; ?>
    <h3><?= e($s['name']) ?></h3>
    <?php if ($s['website']): ?><p><a href="<?= e($s['website']) ?>">Website</a></p><?php endif; ?>
</article>
<?php endforeach; ?>
</div>
<?php endforeach; ?>
<?php if (!$sponsors): ?><p class="muted">Sponsor announcements coming soon.</p><?php endif; ?>
<section class="cta-band">
    <h2>Become a sponsor</h2>
    <p><a class="btn" href="contact.php">Contact the board</a> about sponsorship packages.</p>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
