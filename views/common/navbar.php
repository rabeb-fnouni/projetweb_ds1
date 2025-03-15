<nav>
    <div class="container">
        <ul>
            <li><a href="<?php echo BASE_URL; ?>views\home\index.php">Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>/clubs">Clubs</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="<?php echo BASE_URL; ?>/profile">Profile</a></li>
                <?php if ($_SESSION['user_role'] == 'admin'): ?>
                    <li><a href="<?php echo BASE_URL; ?>views\admin\dashboard.php">Admin Dashboard</a></li>
                <?php endif; ?>
                <li><a href="<?php echo BASE_URL; ?>views\auth\logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="<?php echo BASE_URL; ?>views\auth\login.php">Login</a></li>
                <li><a href="<?php echo BASE_URL; ?>views\auth\register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>