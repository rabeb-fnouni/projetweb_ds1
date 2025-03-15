<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>

<div class="container">
    <h1>Cancel Application</h1>

    <p>Are you sure you want to cancel your application for the club: <strong><?php echo htmlspecialchars($club->name); ?></strong>?</p>

    <form action="<?php echo BASE_URL; ?>/applications/cancel<?php echo $application->id; ?>" method="POST">
        <div>
            <button type="submit" class="btn btn-danger">Yes, Cancel Application</button>
            <a href="<?php echo BASE_URL; ?>/applications" class="btn">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'views\common\footer.php'; ?>