<?php
require_once __DIR__ . '/auth.php';
$subs = $pdo->query('SELECT * FROM subscribers ORDER BY created_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Subscribers | Admin</title>
<link rel="stylesheet" href="../public/assets/css/style.css"></head>
<body><main class="wrap" style="padding-top:2rem">
<h1>Newsletter Subscribers (<?= count($subs) ?>)</h1>
<p><a href="dashboard.php">&larr; Dashboard</a></p>
<table class="admin-table">
<tr><th>Email</th><th>Signed up</th></tr>
<?php foreach ($subs as $s): ?>
<tr><td><?= e($s['email']) ?></td><td><?= e($s['created_at']) ?></td></tr>
<?php endforeach; ?>
</table>
<?php if (!$subs): ?><p class="muted">No subscribers yet.</p><?php endif; ?>
</main></body></html>
