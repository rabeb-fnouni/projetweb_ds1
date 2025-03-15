<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>
<div>
    <img src="<?php echo BASE_URL . '/public/img/clubs/' . $club->logo; ?>" alt="<?php echo $club->name; ?> Logo">
    <p><strong>Description:</strong> <?php echo $club->description; ?></p>
    <p><strong>Foundation Date:</strong> <?php echo date('Y-m-d', strtotime($club->foundation_date)); ?></p>
    <p><strong>Contact Email:</strong> <a href="mailto:<?php echo $club->email; ?>"><?php echo $club->email; ?></a></p>
    <p><strong>Social Media Links:</strong></p>
    <ul>
        <li><a href="<?php echo $club->facebook_link; ?>" target="_blank">Facebook</a></li>
        <li><a href="<?php echo $club->instagram_link; ?>" target="_blank">Instagram</a></li>
        <li><a href="<?php echo $club->twitter_link; ?>" target="_blank">Twitter</a></li>
        <li><a href="<?php echo $club->linkedin_link; ?>" target="_blank">LinkedIn</a></li>
    </ul>
</div>

<?php if ($isMember): ?>
    <p>You are already a member of this club.</p>
<?php else: ?>
    <a href="<?php echo BASE_URL; ?>/clubs/apply/<?php echo $club->id; ?>">Apply for Membership</a>
<?php endif; ?>

<h2>Upcoming Events</h2>
<ul>
    <?php foreach ($events as $event): ?>
    <li>
        <strong><?php echo $event->title; ?></strong> - <?php echo date('Y-m-d H:i', strtotime($event->event_date)); ?>
        <p><?php echo $event->description; ?></p>
    </li>
    <?php endforeach; ?>
</ul>

<?php require_once 'views\common\footer.php'; ?>