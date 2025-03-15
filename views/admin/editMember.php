<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>

<div class="container">
    <h1>Edit Member: <?php echo htmlspecialchars($member->full_name); ?></h1>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="flash-message <?php echo $_SESSION['flash_message']['type']; ?>">
            <?php echo $_SESSION['flash_message']['message']; ?>
            <?php unset($_SESSION['flash_message']); ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo BASE_URL; ?>views\admin\editMember<?php echo $member->id; ?>" method="POST">
        <div>
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" value="<?php echo htmlspecialchars($member->full_name); ?>" required>
            <span class="error"><?php echo isset($full_name_err) ? $full_name_err : ''; ?></span>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($member->email); ?>" required>
            <span class="error"><?php echo isset($email_err) ? $email_err : ''; ?></span>
        </div>
        <div>
            <label for="role">Role</label>
            <select name="role" id="role" required>
                <option value="member" <?php echo $member->role === 'member' ? 'selected' : ''; ?>>Member</option>
                <option value="leader" <?php echo $member->role === 'leader' ? 'selected' : ''; ?>>Leader</option>
                <option value="vice_leader" <?php echo $member->role === 'vice_leader' ? 'selected' : ''; ?>>Vice Leader</option>
                <option value="secretary" <?php echo $member->role === 'secretary' ? 'selected' : ''; ?>>Secretary</option>
                <option value="treasurer" <?php echo $member->role === 'treasurer' ? 'selected' : ''; ?>>Treasurer</option>
            </select>
            <span class="error"><?php echo isset($role_err) ? $role_err : ''; ?></span>
        </div>
        <div>
            <button type="submit">Update Member</button>
        </div>
    </form>
</div>

<?php require_once 'views\common\footer.php'; ?>