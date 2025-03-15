<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>
<h1>Register</h1>
<form action="<?php echo BASE_URL; ?>/auth/register" method="POST" enctype="multipart/form-data">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>" required>
        <span class="error"><?php echo $username_err; ?></span>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
        <span class="error"><?php echo $email_err; ?></span>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <span class="error"><?php echo $password_err; ?></span>
    </div>
    <div>
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <span class="error"><?php echo $confirm_password_err; ?></span>
    </div>
    <div>
        <label for="full_name">Full Name</label>
        <input type="text" name="full_name" id="full_name" value="<?php echo $full_name; ?>" required>
        <span class="error"><?php echo $full_name_err; ?></span>
    </div>
    <div>
        <label for="student_id">Student ID</label>
        <input type="text" name="student_id" id="student_id" value="<?php echo $student_id; ?>" required>
        <span class="error"><?php echo $student_id_err; ?></span>
    </div>
    <div>
        <button type="submit">Register</button>
    </div>
    <div>
        <p>Already have an account? <a href="<?php echo BASE_URL; ?>views\auth\login.php">Login here</a></p>
    </div>
</form>
<?php require_once 'views\common\footer.php'; ?>