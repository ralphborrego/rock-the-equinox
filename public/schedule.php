<?php
$pageTitle = 'Schedule';
require_once __DIR__ . '/../includes/header.php';
$slots = $pdo->query(
    "SELECT s.*, a.name AS artist_name
     FROM schedule_slots s
     LEFT JOIN artists a ON a.id = s.artist_id
     ORDER BY FIELD(s.day,'Friday','Saturday','Sunday'), s.start_time ASC"
)->fetchAll();

$byDay = [];
foreach ($slots as $s) { $byDay[$s['day']][] = $s; }
?>
<h1>Schedule</h1>
<?php foreach ($byDay as $day => $list): ?>
<h2><?= e($day) ?></h2>
<table class="schedule">
    <tr><th>Time</th><th>Artist</th><th>Stage</th><th></th></tr>
    <?php foreach ($list as $s): ?>
    <tr>
        <td><?= e(date('g:i A', strtotime($s['start_time']))) ?> – <?= e(date('g:i A', strtotime($s['end_time']))) ?></td>
        <td><?= e($s['artist_name'] ?? 'TBA') ?></td>
        <td><?= e($s['stage']) ?></td>
        <td class="muted"><?= e($s['notes']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endforeach; ?>
<?php if (!$slots): ?><p class="muted">Set times will be posted as the festival approaches.</p><?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
