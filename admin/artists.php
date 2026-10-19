<?php
require_once __DIR__ . '/auth.php';

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare('DELETE FROM artists WHERE id = ?');
    $stmt->execute([(int)$_GET['delete']]);
    header('Location: artists.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        'INSERT INTO artists (name, genre, bio, image_url, stage, tier, sort_order)
         VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        trim($_POST['name']), trim($_POST['genre']), trim($_POST['bio']),
        trim($_POST['image_url']), trim($_POST['stage'] ?: 'Main Stage'),
        $_POST['tier'] === 'Headliner' ? 'Headliner' : 'Support',
        (int)($_POST['sort_order'] ?? 0),
    ]);
    header('Location: artists.php');
    exit;
}
$artists = $pdo->query('SELECT * FROM artists ORDER BY sort_order, name')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lineup | Admin</title>
<link rel="stylesheet" href="../public/assets/css/style.css"></head>
<body><main class="wrap" style="padding-top:2rem">
<h1>Manage Lineup</h1>
<p><a href="dashboard.php">&larr; Dashboard</a></p>
<table class="admin-table">
<tr><th>#</th><th>Name</th><th>Tier</th><th>Genre</th><th>Stage</th><th></th></tr>
<?php foreach ($artists as $a): ?>
<tr>
    <td><?= (int)$a['sort_order'] ?></td>
    <td><?= e($a['name']) ?></td>
    <td><?= e($a['tier'] ?? 'Support') ?></td>
    <td><?= e($a['genre']) ?></td>
    <td><?= e($a['stage']) ?></td>
    <td><a href="?delete=<?= (int)$a['id'] ?>" onclick="return confirm('Delete this artist?')">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
<h2>Add Artist</h2>
<form method="post" class="form" style="max-width:520px">
    <label>Name <input type="text" name="name" required></label>
    <label>Genre <input type="text" name="genre" placeholder="Rock"></label>
    <label>Stage <input type="text" name="stage" value="Main Stage"></label>
    <label>Tier
        <select name="tier"><option>Support</option><option>Headliner</option></select>
    </label>
    <label>Sort order <input type="number" name="sort_order" value="0"></label>
    <label>Image URL <input type="url" name="image_url" placeholder="https://..."></label>
    <label>Bio <textarea name="bio" rows="4"></textarea></label>
    <button class="btn btn-primary" type="submit">Add Artist</button>
</form>
</main></body></html>
