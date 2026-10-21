<?php
$pageTitle = 'Sponsors';
require_once __DIR__ . '/../includes/header.php';
$sponsors = $pdo->query("SELECT * FROM sponsors ORDER BY sort_order ASC, name ASC")->fetchAll();
$majors = [];
$others = [];
foreach ($sponsors as $s) {
    if (strcasecmp($s['tier'], 'Major') === 0) { $majors[] = $s; }
    else { $others[$s['tier']][] = $s; }
}
?>
<h1>Sponsors</h1>
<p>Rock the Equinox is community-powered. Thank you to the folks who keep the amps on — click through and show them some love.</p>

<?php if ($majors): ?>
<h2>Major sponsors</h2>
<div class="sponsor-majors">
<?php foreach ($majors as $s): ?>
    <article class="sponsor-major">
        <?php if ($s['website']): ?>
        <a href="<?= e($s['website']) ?>" target="_blank" rel="noopener">
            <?php if ($s['logo_url']): ?><img src="<?= e($s['logo_url']) ?>" alt="<?= e($s['name']) ?>"><?php endif; ?>
            <span class="sponsor-name"><?= e($s['name']) ?></span>
        </a>
        <?php else: ?>
            <?php if ($s['logo_url']): ?><img src="<?= e($s['logo_url']) ?>" alt="<?= e($s['name']) ?>"><?php endif; ?>
            <span class="sponsor-name"><?= e($s['name']) ?></span>
        <?php endif; ?>
    </article>
<?php endforeach; ?>
</div>
<?php endif; ?>

<?php foreach ($others as $tier => $list): ?>
<h2><?= e($tier) ?> sponsors</h2>
<p class="sponsor-names">
<?php foreach ($list as $i => $s): ?>
    <?php if ($i): ?><span class="sep">///</span><?php endif; ?>
    <?php if ($s['website']): ?><a href="<?= e($s['website']) ?>" target="_blank" rel="noopener"><?= e($s['name']) ?></a><?php else: ?><?= e($s['name']) ?><?php endif; ?>
<?php endforeach; ?>
</p>
<?php endforeach; ?>

<?php if (!$sponsors): ?><p class="muted">Sponsor announcements coming soon.</p><?php endif; ?>
<section class="cta-band">
    <h2>Become a sponsor</h2>
    <p><a class="btn" href="contact.php">Contact the board</a> about sponsorship packages.</p>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
