<?php
$pageTitle = 'FAQ';
require_once __DIR__ . '/../includes/header.php';
$faqs = $pdo->query("SELECT * FROM faqs ORDER BY sort_order ASC")->fetchAll();
?>
<h1>Questions? We've got answers.</h1>
<?php foreach ($faqs as $f): ?>
<div class="faq-item">
    <h3><?= e($f['question']) ?></h3>
    <p><?= nl2br(e($f['answer'])) ?></p>
</div>
<?php endforeach; ?>
<?php if (!$faqs): ?><p class="muted">FAQs coming soon.</p><?php endif; ?>
<p style="margin-top:2rem">Still stuck? <a href="contact.php">Contact the board</a>.</p>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
