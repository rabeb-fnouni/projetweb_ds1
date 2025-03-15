<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>

<div class="container">
    <h1><?php echo htmlspecialchars($club->name); ?></h1>
    <div class="club-details">
        <img src="<?php echo BASE_URL . 'public\img\clubs' . htmlspecialchars($club->logo); ?>" alt="<?php echo htmlspecialchars($club->name); ?> Logo" class="club-logo">
        <p><strong>Description:</strong> <?php echo htmlspecialchars($club->description); ?></p>
        <p><strong>Foundation Date:</strong> <?php echo date('Y-m-d', strtotime($club->foundation_date)); ?></p>
        <p><strong>Contact Email:</strong> <a href="mailto:<?php echo htmlspecialchars($club->email); ?>"><?php echo htmlspecialchars($club->email); ?></a></p>
        <p><strong>Social Media Links:</strong></p>
        <ul>
            <li><a href="<?php echo htmlspecialchars($club->facebook_link); ?>" target="_blank">Facebook</a></li>
            <li><a href="<?php echo htmlspecialchars($club->instagram_link); ?>" target="_blank">Instagram</a></li>
            <li><a href="<?php echo htmlspecialchars($club->twitter_link); ?>" target="_blank">Twitter</a></li>
            <li><a href="<?php echo htmlspecialchars($club->linkedin_link); ?>" target="_blank">LinkedIn</a></li>
        </ul>
    </div>

    <h2>Upcoming Events</h2>
    <div class="events-list">
        <?php if (!empty($events)): ?>
            <ul>
                <?php foreach ($events as $event): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($event->title); ?></h3>
                        <p><?php echo htmlspecialchars($event->description); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($event->location); ?></p>
                        <p><strong>Date:</strong> <?php echo date('Y-m-d H:i', strtotime($event->event_date)); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No upcoming events for this club at the moment.</p>
        <?php endif; ?>
    </div>

    <h2>Membership</h2>
    <?php if ($isMember): ?>
        <p>You are already a member of this club.</p>
    <?php else: ?>
        <a href="<?php echo BASE_URL; ?>views\clubs\apply.php<?php echo $club->id; ?>" class="btn">Apply for Membership</a>
    <?php endif; ?>
</div>

<?php require_once 'views\common\footer.php'; ?>