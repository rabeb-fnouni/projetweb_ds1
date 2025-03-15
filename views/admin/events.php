<?php require_once 'views\common\header.php'; ?>
<h1>Manage Events</h1>
<table>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Location</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($events as $event): ?>
    <tr>
        <td><?php echo $event->title; ?></td>
        <td><?php echo $event->description; ?></td>
        <td><?php echo $event->location; ?></td>
        <td><?php echo date('Y-m-d H:i', strtotime($event->event_date)); ?></td>
        <td>
            <a href="<?php echo BASE_URL; ?>views\admin\editEvent.php<?php echo $event->id; ?>">Edit</a>
            <a href="<?php echo BASE_URL; ?>views\admin\deleteEvent.php<?php echo $event->id; ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php require_once 'views\common\footer.php'; ?>