<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>

<div class="container">
    <h1>Remove Member</h1>

    <p>Are you sure you want to remove the member: <strong><?php echo htmlspecialchars($member->full_name); ?></strong>?</p>

    <form action="<?php echo BASE_URL; ?>views\admin\removeMember.php<?php echo $member->id; ?>" method="POST">
        <div>
            <button type="submit" class="btn btn-danger">Yes, Remove Member</button>
            <a href="<?php echo BASE_URL; ?>views\admin\members.php" class="btn">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'views\common\footer.php'; ?>