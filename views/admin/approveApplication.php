<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>

<div class="container">
    <h1>Approve Application</h1>

    <p>Are you sure you want to approve the application from <strong><?php echo htmlspecialchars($application->full_name); ?></strong> for the club: <strong><?php echo htmlspecialchars($club->name); ?></strong>?</p>

    <form action="<?php echo BASE_URL; ?>/admin/approveApplication<?php echo $application->id; ?>" method="POST">
        <div>
            <button type="submit" class="btn btn-success">Yes, Approve Application</button>
            <a href="<?php echo BASE_URL; ?>/admin/applications" class="btn">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'views\common\footer.php'; ?>