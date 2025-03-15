<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>

<div class="container">
    <h1>Edit Event: <?php echo htmlspecialchars($event->title); ?></h1>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="flash-message <?php echo $_SESSION['flash_message']['type']; ?>">
            <?php echo $_SESSION['flash_message']['message']; ?>
            <?php unset($_SESSION['flash_message']); ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo BASE_URL; ?>views\admin\editEvent<?php echo $event->id; ?>" method="POST">
        <div>
            <label for="title">Event Title</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($event->title); ?>" required>
            <span class="error"><?php echo isset($title_err) ? $title_err : ''; ?></span>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5" required><?php echo htmlspecialchars($event->description); ?></textarea>
            <span class="error"><?php echo isset($description_err) ? $description_err : ''; ?></span>
        </div>
        <div>
            <label for="location">Location</label>
            <input type="text" name="location" id="location" value="<?php echo htmlspecialchars($event->location); ?>" required>
            <span class="error"><?php echo isset($location_err) ? $location_err : ''; ?></span>
        </div>
        <div>
            <label for="event_date">Event Date and Time</label>
            <input type="datetime-local" name="event_date" id="event_date" value="<?php echo date('Y-m-d\TH:i', strtotime($event->event_date)); ?>" required>
            <span class="error"><?php echo isset($event_date_err) ? $event_date_err : ''; ?></span>
        </div>
        <div>
            <button type="submit">Update Event</button>
        </div>
    </form>
</div>

<?php require_once 'views\common\footer.php'; ?>