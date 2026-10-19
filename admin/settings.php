<?php
require_once __DIR__ . '/auth.php';
$editable = ['site_name', 'tagline', 'event_dates', 'event_start', 'venue',
            'ticket_url', 'contact_email', 'facebook_url', 'instagram_url', 'youtube_url'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO settings (`key`, `value`) VALUES (?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)');
    foreach ($editable as $k) {
        $stmt->execute([$k, trim($_POST[$k] ?? '')]);
    }
    header('Location: settings.php?saved=1');
    exit;
}
$current = [];
foreach ($editable as $k) { $current[$k] = setting($pdo, $k, ''); }
$labels = ['site_name' => 'Site name', 'tagline' => 'Tagline', 'event_dates' => 'Event dates',
           'event_start' => 'Event start (ISO, e.g. 2027-09-03T12:00:00 — drives the countdown)',
           'venue' => 'Venue', 'ticket_url' => 'Ticket URL', 'contact_email' => 'Contact email',
           'facebook_url' => 'Facebook URL', 'instagram_url' => 'Instagram URL', 'youtube_url' => 'YouTube URL'];
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Settings | Admin</title>
<link rel="stylesheet" href="../public/assets/css/style.css"></head>
<body><main class="wrap" style="padding-top:2rem;max-width:640px">
<h1>Site Settings</h1>
<p><a href="dashboard.php">&larr; Dashboard</a></p>
<?php if (isset($_GET['saved'])): ?><p class="success">Saved.</p><?php endif; ?>
<form method="post" class="form">
<?php foreach ($editable as $k): ?>
    <label><?= $labels[$k] ?> <input type="text" name="<?= $k ?>" value="<?= e($current[$k]) ?>"></label>
<?php endforeach; ?>
    <button class="btn btn-primary" type="submit">Save Settings</button>
</form>
</main></body></html>
