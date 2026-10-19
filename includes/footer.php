<?php // footer.php — expects $pdo from header.php
$fb = setting($pdo, 'facebook_url', '');
$ig = setting($pdo, 'instagram_url', '');
$yt = setting($pdo, 'youtube_url', '');
$subscribed = isset($_GET['subscribed']);
?>
</main>

<section class="wrap">
    <div class="newsletter-band">
        <h2>Be first to know</h2>
        <p class="muted">Lineup drops, ticket on-sales, and festival news — straight to your inbox.</p>
        <?php if ($subscribed): ?>
            <p class="success">You're on the list. See you in the pit.</p>
        <?php else: ?>
            <form class="newsletter-form" method="post" action="subscribe.php">
                <input type="email" name="email" placeholder="your@email.com" required>
                <button class="btn btn-primary" type="submit">Sign Up</button>
            </form>
        <?php endif; ?>
    </div>
</section>

<footer class="site-footer">
    <div class="wrap">
        <div class="footer-grid">
            <div>
                <p><strong><?= e(strtoupper(setting($pdo, 'site_name', 'Rock the Equinox'))) ?></strong></p>
                <p class="muted"><?= e(setting($pdo, 'venue', 'Stigler, OK')) ?> &middot; <?= e(setting($pdo, 'event_dates', 'Dates TBA')) ?></p>
            </div>
            <div class="social">
                <?php if ($fb): ?><a href="<?= e($fb) ?>">Facebook</a><?php endif; ?>
                <?php if ($ig): ?><a href="<?= e($ig) ?>">Instagram</a><?php endif; ?>
                <?php if ($yt): ?><a href="<?= e($yt) ?>">YouTube</a><?php endif; ?>
            </div>
        </div>
        <p class="copyright">&copy; <?= date('Y') ?> <?= e(setting($pdo, 'site_name', 'Rock the Equinox')) ?>. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
