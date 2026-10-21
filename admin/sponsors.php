<?php
require_once __DIR__ . '/auth.php';

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare('DELETE FROM sponsors WHERE id = ?');
    $stmt->execute([(int)$_GET['delete']]);
    header('Location: sponsors.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        'INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
         VALUES (?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        trim($_POST['name']),
        trim($_POST['tier'] ?: 'Bronze'),
        trim($_POST['logo_url']),
        trim($_POST['website']),
        (int)($_POST['sort_order'] ?? 0),
    ]);
    header('Location: sponsors.php');
    exit;
}
$sponsors = $pdo->query('SELECT * FROM sponsors ORDER BY sort_order, name')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sponsors | Admin</title>
<link rel="stylesheet" href="../public/assets/css/style.css"></head>
<body><main class="wrap" style="padding-top:2rem">
<h1>Manage Sponsors</h1>
<p><a href="dashboard.php">&larr; Dashboard</a></p>
<p class="muted">Tier <strong>Major</strong> shows a big logo that links to the sponsor's website (opens in a new tab).
Any other tier shows just the linked name. Logo path is relative to the public folder,
e.g. <code>assets/img/sponsors/their-logo.jpg</code> — upload the file there first.</p>
<table class="admin-table">
<tr><th>#</th><th>Name</th><th>Tier</th><th>Website</th><th>Logo</th><th></th></tr>
<?php foreach ($sponsors as $s): ?>
<tr>
    <td><?= (int)$s['sort_order'] ?></td>
    <td><?= e($s['name']) ?></td>
    <td><?= e($s['tier']) ?></td>
    <td><?= e($s['website']) ?></td>
    <td><?= e($s['logo_url']) ?></td>
    <td><a href="?delete=<?= (int)$s['id'] ?>" onclick="return confirm('Delete this sponsor?')">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
<h2>Add Sponsor</h2>
<form method="post" class="form" style="max-width:520px">
    <label>Name <input type="text" name="name" required></label>
    <label>Tier
        <select name="tier">
            <option>Major</option>
            <option>Gold</option>
            <option>Silver</option>
            <option selected>Bronze</option>
            <option>Community</option>
        </select>
    </label>
    <label>Sort order <input type="number" name="sort_order" value="0"></label>
    <label>Website <input type="url" name="website" placeholder="https://..."></label>
    <label>Logo path <input type="text" name="logo_url" placeholder="assets/img/sponsors/logo.jpg (Major tier only)"></label>
    <button class="btn btn-primary" type="submit">Add Sponsor</button>
</form>
</main></body></html>
