<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>

<div class="container">
    <h1>Welcome to ESSECT Clubs</h1>
    <p>Discover the various clubs at ESSECT and get involved!</p>

    <h2>Featured Clubs</h2>
    <div class="clubs-list">
        <?php if (!empty($clubs)): ?>
            <ul>
                <?php foreach ($clubs as $club): ?>
                    <li>
                        <h3><?php echo $club->name; ?></h3>
                        <p><?php echo $club->description; ?></p>
                        <p><strong>Foundation Date:</strong> <?php echo date('Y-m-d', strtotime($club->foundation_date)); ?></p>
                        <a href="<?php echo BASE_URL; ?>views\clubs\show.php<?php echo $club->id; ?>">View Details</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No clubs available at the moment. Please check back later!</p>
        <?php endif; ?>
    </div>

    <h2>Upcoming Events</h2>
    <div class="events-list">
        <?php if (!empty($events)): ?>
            <ul>
                <?php foreach ($events as $event): ?>
                    <li>
                        <h3><?php echo $event->title; ?></h3>
                        <p><?php echo $event->description; ?></p>
                        <p><strong>Location:</strong> <?php echo $event->location; ?></p>
                        <p><strong>Date:</strong> <?php echo date('Y-m-d H:i', strtotime($event->event_date)); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No upcoming events at the moment. Please check back later!</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'views\common\footer.php'; ?>