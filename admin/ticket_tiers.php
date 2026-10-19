<?php
require_once __DIR__ . '/auth.php';

if (isset($_GET['delete'])) {
    $pdo->prepare('DELETE FROM ticket_tiers WHERE id = ?')->execute([(int)$_GET['delete']]);
    header('Location: ticket_tiers.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        'INSERT INTO ticket_tiers (name, price, description, url, featured, sort_order)
         VALUES (?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        trim($_POST['name']), trim($_POST['price']), trim($_POST['description']),
        trim($_POST['url']), isset($_POST['featured']) ? 1 : 0,
        (int)($_POST['sort_order'] ?? 0),
    ]);
    header('Location: ticket_tiers.php');
    exit;
}
$tiers = $pdo->query('SELECT * FROM ticket_tiers ORDER BY sort_order, name')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ticket Tiers | Admin</title>
<link rel="stylesheet" href="../public/assets/css/style.css"></head>
<body><main class="wrap" style="padding-top:2rem">
<h1>Ticket Tiers</h1>
<p><a href="dashboard.php">&larr; Dashboard</a></p>
<table class="admin-table">
<tr><th>#</th><th>Name</th><th>Price</th><th>Featured</th><th></th></tr>
<?php foreach ($tiers as $t): ?>
<tr>
    <td><?= (int)$t['sort_order'] ?></td>
    <td><?= e($t['name']) ?></td>
    <td><?= e($t['price']) ?></td>
    <td><?= $t['featured'] ? 'Yes' : '' ?></td>
    <td><a href="?delete=<?= (int)$t['id'] ?>" onclick="return confirm('Delete this tier?')">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
<h2>Add Tier</h2>
<form method="post" class="form" style="max-width:520px">
    <label>Name <input type="text" name="name" required placeholder="General Admission"></label>
    <label>Price <input type="text" name="price" placeholder="$99"></label>
    <label>URL <input type="url" name="url" placeholder="https://..."></label>
    <label>Sort order <input type="number" name="sort_order" value="0"></label>
    <label><input type="checkbox" name="featured" style="width:auto;display:inline"> Featured (highlighted card)</label>
    <label>Description <textarea name="description" rows="4"></textarea></label>
    <button class="btn btn-primary" type="submit">Add Tier</button>
</form>
</main></body></html>
