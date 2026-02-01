<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <h1>Inventaris Lab</h1>

    <ul>
        <li><a href="index.php">Home</a></li>
    </ul>
    
    <ul>
        <?php if (isset($_SESSION['user'])) : ?>
            <li>
                Halo, <strong><?= htmlspecialchars($_SESSION['user']['nama']) ?></strong>
                (<?= $_SESSION['user']['role'] ?>)
            </li>

            <?php if (
                $_SESSION['user']['role'] === 'admin' ||
                $_SESSION['user']['role'] === 'petugas'
            ) : ?>
                <li><a href="dashboard.php">Dashboard</a></li>
            <?php endif; ?>

            <li><a href="auth/logout.php">Logout</a></li>

        <?php else : ?>
            <li><a href="auth/login.php">Login</a></li>
            <li><a href="auth/register.php">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>

<hr>
