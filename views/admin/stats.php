<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>
<h1>Statistics</h1>
<div class="stats-overview">
    <h2>Club Membership Statistics</h2>
    <table>
        <tr>
            <th>Club Name</th>
            <th>Member Count</th>
        </tr>
        <?php foreach ($clubStats as $stat): ?>
        <tr>
            <td><?php echo $stat->name; ?></td>
            <td><?php echo $stat->member_count; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Application Statistics</h2>
    <table>
        <tr>
            <th>Club Name</th>
            <th>Total Applications</th>
            <th>Pending Applications</th>
            <th>Approved Applications</th>
            <th>Rejected Applications</th>
        </tr>
        <?php foreach ($applicationStats as $stat): ?>
        <tr>
            <td><?php echo $stat->name; ?></td>
            <td><?php echo $stat->total_applications; ?></td>
            <td><?php echo $stat->pending_applications; ?></td>
            <td><?php echo $stat->approved_applications; ?></td>
            <td><?php echo $stat->rejected_applications; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php require_once 'views\common\footer.php'; ?>