<?php
$pageTitle = 'Contact';
require_once __DIR__ . '/../includes/header.php';

$sent = false;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if ($name === '') $errors[] = 'Name is required.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';
    if ($message === '') $errors[] = 'Message is required.';
    if (!$errors) {
        $stmt = $pdo->prepare(
            'INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$name, $email, $subject, $message]);
        $sent = true;
    }
}
?>
<h1>Contact</h1>
<?php if ($sent): ?>
    <p class="success">Thanks — your message is in. A board member will get back to you.</p>
<?php else: ?>
    <?php foreach ($errors as $err): ?><p class="error"><?= e($err) ?></p><?php endforeach; ?>
    <form method="post" class="form">
        <label>Name <input type="text" name="name" required value="<?= e($_POST['name'] ?? '') ?>"></label>
        <label>Email <input type="email" name="email" required value="<?= e($_POST['email'] ?? '') ?>"></label>
        <label>Subject
            <select name="subject">
                <option>General question</option>
                <option>Performing at the festival</option>
                <option>Vending</option>
                <option>Sponsorship</option>
                <option>Volunteering</option>
            </select>
        </label>
        <label>Message <textarea name="message" rows="6" required><?= e($_POST['message'] ?? '') ?></textarea></label>
        <button class="btn btn-primary" type="submit">Send Message</button>
    </form>
<?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
