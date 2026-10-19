<?php
// Admin login. Create the first admin with:
//   php -r "echo password_hash('YOUR_PASSWORD', PASSWORD_DEFAULT), PHP_EOL;"
// then: INSERT INTO admins (username, password_hash) VALUES ('admin', '<hash>');
session_start();
require_once __DIR__ . '/../includes/db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = ?');
    $stmt->execute([$_POST['username'] ?? '']);
    $admin = $stmt->fetch();
    if ($admin && password_verify($_POST['password'] ?? '', $admin['password_hash'])) {
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Invalid login.';
}
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login | Rock the Equinox</title>
<link rel="stylesheet" href="../public/assets/css/style.css"></head>
<body><main class="wrap" style="max-width:420px;padding-top:4rem">
<h1>Board Login</h1>
<?php if ($error): ?><p class="error"><?= e($error) ?></p><?php endif; ?>
<form method="post" class="form">
    <label>Username <input type="text" name="username" required></label>
    <label>Password <input type="password" name="password" required></label>
    <button class="btn btn-primary" type="submit">Log In</button>
</form>
</main></body></html>
