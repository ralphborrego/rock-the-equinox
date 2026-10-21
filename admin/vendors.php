<?php
require_once __DIR__ . '/auth.php';

if (isset($_GET['approve'])) {
    $stmt = $pdo->prepare('UPDATE vendors SET approved = 1 WHERE id = ?');
    $stmt->execute([(int)$_GET['approve']]);
    header('Location: vendors.php');
    exit;
}
if (isset($_GET['unapprove'])) {
    $stmt = $pdo->prepare('UPDATE vendors SET approved = 0 WHERE id = ?');
    $stmt->execute([(int)$_GET['unapprove']]);
    header('Location: vendors.php');
    exit;
}
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare('DELETE FROM vendors WHERE id = ?');
    $stmt->execute([(int)$_GET['delete']]);
    header('Location: vendors.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        'INSERT INTO vendors (name, type, description, contact_email, website, approved)
         VALUES (?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        trim($_POST['name']),
        trim($_POST['type']),
        trim($_POST['description']),
        trim($_POST['contact_email']),
        trim($_POST['website']),
        isset($_POST['approved']) ? 1 : 0,
    ]);
    header('Location: vendors.php');
    exit;
}
$vendors = $pdo->query('SELECT * FROM vendors ORDER BY approved ASC, name ASC')->fetchAll();
$pending = count(array_filter($vendors, fn($v) => !$v['approved']));
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vendors | Admin</title>
<link rel="stylesheet" href="../public/assets/css/style.css"></head>
<body><main class="wrap" style="padding-top:2rem">
<h1>Manage Vendors</h1>
<p><a href="dashboard.php">&larr; Dashboard</a></p>
<p class="muted">Only <strong>Live</strong> vendors show on the public Vendors page.
<?php if ($pending): ?><strong><?= $pending ?> vendor<?= $pending === 1 ? ' is' : 's are' ?> waiting for approval.</strong><?php endif; ?></p>
<table class="admin-table">
<tr><th>Name</th><th>Type</th><th>Contact</th><th>Website</th><th>Status</th><th></th></tr>
<?php foreach ($vendors as $v): ?>
<tr>
    <td><?= e($v['name']) ?></td>
    <td><?= e($v['type']) ?></td>
    <td><?= e($v['contact_email']) ?></td>
    <td><?= e($v['website']) ?></td>
    <td><?= $v['approved'] ? 'Live' : 'Pending' ?></td>
    <td>
        <?php if ($v['approved']): ?>
        <a href="?unapprove=<?= (int)$v['id'] ?>">Unapprove</a>
        <?php else: ?>
        <a href="?approve=<?= (int)$v['id'] ?>">Approve</a>
        <?php endif; ?>
        &middot;
        <a href="?delete=<?= (int)$v['id'] ?>" onclick="return confirm('Delete this vendor?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
<?php if (!$vendors): ?>
<tr><td colspan="6" class="muted">No vendors yet — add the first one below.</td></tr>
<?php endif; ?>
</table>
<h2>Add Vendor</h2>
<form method="post" class="form" style="max-width:520px">
    <label>Name <input type="text" name="name" required></label>
    <label>Type <input type="text" name="type" placeholder="Food, Merch, Services..."></label>
    <label>Contact email <input type="email" name="contact_email"></label>
    <label>Website <input type="url" name="website" placeholder="https://..."></label>
    <label>Description <textarea name="description" rows="4"></textarea></label>
    <label><input type="checkbox" name="approved" value="1" checked> Show on public site immediately</label>
    <button class="btn btn-primary" type="submit">Add Vendor</button>
</form>
</main></body></html>
