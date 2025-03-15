<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>
<h1>Login</h1>
<form action="<?php echo BASE_URL; ?>views\auth\login.php" method="POST">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>" required>
        <span class="error"><?php echo $username_err; ?></span>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <span class="error"><?php echo $password_err; ?></span>
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
    <div>
        <p>Don't have an account? <a href="<?php echo BASE_URL; ?>views\auth\register.php">Register here</a></p>
    </div>
</form>
<?php require_once 'views\common\footer.php'; ?>