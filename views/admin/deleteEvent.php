<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>

<div class="container">
    <h1>Delete Event</h1>

    <p>Are you sure you want to delete the event: <strong><?php echo htmlspecialchars($event->title); ?></strong>?</p>

    <form action="<?php echo BASE_URL; ?>views\admin\deleteEvent.php<?php echo $event->id; ?>" method="POST">
        <div>
            <button type="submit" class="btn btn-danger">Yes, Delete Event</button>
            <a href="<?php echo BASE_URL; ?>views\admin\events.php" class="btn">Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'views\common\footer.php'; ?>