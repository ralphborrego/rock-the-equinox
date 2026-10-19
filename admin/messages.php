<?php
require_once __DIR__ . '/auth.php';
if (isset($_GET['read'])) {
    $pdo->prepare('UPDATE messages SET is_read = 1 WHERE id = ?')->execute([(int)$_GET['read']]);
    header('Location: messages.php');
    exit;
}
$msgs = $pdo->query('SELECT * FROM messages ORDER BY created_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Messages | Admin</title>
<link rel="stylesheet" href="../public/assets/css/style.css"></head>
<body><main class="wrap" style="padding-top:2rem">
<h1>Contact Messages</h1>
<p><a href="dashboard.php">&larr; Dashboard</a></p>
<?php foreach ($msgs as $m): ?>
<article class="card" style="margin-bottom:1rem;<?= $m['is_read'] ? '' : 'border-color:var(--accent-2);' ?>">
    <h3><?= e($m['subject'] ?: '(no subject)') ?> <?= $m['is_read'] ? '' : '<span class="muted">— new</span>' ?></h3>
    <p class="muted">From <?= e($m['name']) ?> &lt;<?= e($m['email']) ?>&gt; on <?= e($m['created_at']) ?></p>
    <p><?= nl2br(e($m['message'])) ?></p>
    <?php if (!$m['is_read']): ?><p><a href="?read=<?= (int)$m['id'] ?>">Mark read</a></p><?php endif; ?>
</article>
<?php endforeach; ?>
<?php if (!$msgs): ?><p class="muted">No messages yet.</p><?php endif; ?>
</main></body></html>
