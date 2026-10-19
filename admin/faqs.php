<?php
require_once __DIR__ . '/auth.php';

if (isset($_GET['delete'])) {
    $pdo->prepare('DELETE FROM faqs WHERE id = ?')->execute([(int)$_GET['delete']]);
    header('Location: faqs.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO faqs (question, answer, sort_order) VALUES (?, ?, ?)');
    $stmt->execute([trim($_POST['question']), trim($_POST['answer']), (int)($_POST['sort_order'] ?? 0)]);
    header('Location: faqs.php');
    exit;
}
$faqs = $pdo->query('SELECT * FROM faqs ORDER BY sort_order')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FAQs | Admin</title>
<link rel="stylesheet" href="../public/assets/css/style.css"></head>
<body><main class="wrap" style="padding-top:2rem">
<h1>FAQs</h1>
<p><a href="dashboard.php">&larr; Dashboard</a></p>
<table class="admin-table">
<tr><th>#</th><th>Question</th><th></th></tr>
<?php foreach ($faqs as $f): ?>
<tr>
    <td><?= (int)$f['sort_order'] ?></td>
    <td><?= e($f['question']) ?></td>
    <td><a href="?delete=<?= (int)$f['id'] ?>" onclick="return confirm('Delete this FAQ?')">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
<h2>Add FAQ</h2>
<form method="post" class="form" style="max-width:640px">
    <label>Question <input type="text" name="question" required></label>
    <label>Sort order <input type="number" name="sort_order" value="0"></label>
    <label>Answer <textarea name="answer" rows="4" required></textarea></label>
    <button class="btn btn-primary" type="submit">Add FAQ</button>
</form>
</main></body></html>
