<?php
require_once __DIR__ . '/auth.php';

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare('DELETE FROM schedule_slots WHERE id = ?');
    $stmt->execute([(int)$_GET['delete']]);
    header('Location: schedule_admin.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        'INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
         VALUES (?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        $_POST['artist_id'] !== '' ? (int)$_POST['artist_id'] : null,
        trim($_POST['stage'] ?: 'Main Stage'), trim($_POST['day']),
        $_POST['start_time'], $_POST['end_time'], trim($_POST['notes']),
    ]);
    header('Location: schedule_admin.php');
    exit;
}
$artists = $pdo->query('SELECT id, name FROM artists ORDER BY name')->fetchAll();
$slots = $pdo->query(
    "SELECT s.*, a.name AS artist_name FROM schedule_slots s
     LEFT JOIN artists a ON a.id = s.artist_id
     ORDER BY FIELD(s.day,'Friday','Saturday','Sunday'), s.start_time"
)->fetchAll();
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Schedule | Admin</title>
<link rel="stylesheet" href="../public/assets/css/style.css"></head>
<body><main class="wrap" style="padding-top:2rem">
<h1>Manage Schedule</h1>
<p><a href="dashboard.php">&larr; Dashboard</a></p>
<table class="admin-table">
<tr><th>Day</th><th>Time</th><th>Artist</th><th>Stage</th><th></th></tr>
<?php foreach ($slots as $s): ?>
<tr>
    <td><?= e($s['day']) ?></td>
    <td><?= e($s['start_time']) ?>–<?= e($s['end_time']) ?></td>
    <td><?= e($s['artist_name'] ?? 'TBA') ?></td>
    <td><?= e($s['stage']) ?></td>
    <td><a href="?delete=<?= (int)$s['id'] ?>" onclick="return confirm('Delete this slot?')">Delete</a></td>
</tr>
<?php endforeach; ?>
</table>
<h2>Add Slot</h2>
<form method="post" class="form" style="max-width:520px">
    <label>Day
        <select name="day"><option>Friday</option><option>Saturday</option><option>Sunday</option></select>
    </label>
    <label>Artist
        <select name="artist_id"><option value="">TBA</option>
        <?php foreach ($artists as $a): ?><option value="<?= (int)$a['id'] ?>"><?= e($a['name']) ?></option><?php endforeach; ?>
        </select>
    </label>
    <label>Stage <input type="text" name="stage" value="Main Stage"></label>
    <label>Start <input type="time" name="start_time" required></label>
    <label>End <input type="time" name="end_time" required></label>
    <label>Notes <input type="text" name="notes"></label>
    <button class="btn btn-primary" type="submit">Add Slot</button>
</form>
</main></body></html>
