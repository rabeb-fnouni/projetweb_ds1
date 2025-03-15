<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>
<h1>Clubs</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Foundation Date</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($clubs as $club): ?>
    <tr>
        <td><?php echo $club->name; ?></td>
        <td><?php echo $club->description; ?></td>
        <td><?php echo date('Y-m-d', strtotime($club->foundation_date)); ?></td>
        <td>
            <a href="<?php echo BASE_URL; ?>/clubs/show/<?php echo $club->id; ?>">View Details</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php require_once 'views\common\footer.php'; ?>