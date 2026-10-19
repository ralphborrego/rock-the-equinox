<?php // footer.php — expects $pdo from header.php ?>
</main>
<footer class="site-footer">
    <div class="wrap">
        <p>&copy; <?= date('Y') ?> <?= e(setting($pdo, 'site_name', 'Rock the Equinox')) ?> &middot; Stigler, Oklahoma</p>
        <p class="muted">Questions? <a href="contact.php">Contact the board</a></p>
    </div>
</footer>
</body>
</html>
