<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="navbar">
    <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
    <?php else: ?>
        <a href="user_info.php"><?php echo $row['username']; ?></a>
        <a href="logout.php">Logout</a>
    <?php endif; ?>
    <h1>Skill Test</h1>
</div>
