<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>
<h1>Manage Members</h1>
<table>
    <tr>
        <th>Member Name</th>
        <th>Club</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($members as $member): ?>
    <tr>
        <td><?php echo $member->full_name; ?></td>
        <td><?php echo $member->club_name; ?></td>
        <td><?php echo ucfirst($member->role); ?></td>
        <td>
            <a href="<?php echo BASE_URL; ?>/admin/editMember/<?php echo $member->id; ?>">Edit</a>
            <a href="<?php echo BASE_URL; ?>/admin/removeMember/<?php echo $member->id; ?>">Remove</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php require_once 'views\common\footer.php'; ?>