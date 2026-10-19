<?php
require_once __DIR__ . '/../includes/db.php';
$email = trim($_POST['email'] ?? '');
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    try {
        $stmt = $pdo->prepare('INSERT INTO subscribers (email) VALUES (?)');
        $stmt->execute([$email]);
    } catch (PDOException $e) {
        // duplicate email — treat as success
    }
}
header('Location: index.php?subscribed=1');
exit;
