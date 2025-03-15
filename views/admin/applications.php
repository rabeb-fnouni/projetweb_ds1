<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>
<h1>Manage Applications</h1>
<table>
    <tr>
        <th>Applicant Name</th>
        <th>Club</th>
        <th>CV</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($applications as $application): ?>
    <tr>
        <td><?php echo $application->full_name; ?></td>
        <td><?php echo $application->club_name; ?></td>
        <td><a href="<?php echo UPLOAD_DIR . 'cv/' . $application->cv_file; ?>" target="_blank">View CV</a></td>
        <td><?php echo ucfirst($application->status); ?></td>
        <td>
            <a href="<?php echo BASE_URL; ?>/admin/approveApplication/<?php echo $application->id; ?>">Approve</a>
            <a href="<?php echo BASE_URL; ?>/admin/rejectApplication/<?php echo $application->id; ?>">Reject</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php require_once 'views\common\footer.php'; ?>