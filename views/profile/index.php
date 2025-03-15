<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>

<div class="container">
    <h1>User Profile</h1>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="flash-message <?php echo $_SESSION['flash_message']['type']; ?>">
            <?php echo $_SESSION['flash_message']['message']; ?>
            <?php unset($_SESSION['flash_message']); ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo BASE_URL; ?>/profile/update" method="POST">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?php echo $user->username; ?>" required>
            <span class="error"><?php echo $username_err; ?></span>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $user->email; ?>" required>
            <span class="error"><?php echo $email_err; ?></span>
        </div>
        <div>
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" value="<?php echo $user->full_name; ?>" required>
            <span class="error"><?php echo $full_name_err; ?></span>
        </div>
        <div>
            <label for="student_id">Student ID</label>
            <input type="text" name="student_id" id="student_id" value="<?php echo $user->student_id; ?>" required>
            <span class="error"><?php echo $student_id_err; ?></span>
        </div>
        <div>
            <button type="submit">Update Profile</button>
        </div>
    </form>
</div>

<?php require_once 'views\common\footer.php'; ?>