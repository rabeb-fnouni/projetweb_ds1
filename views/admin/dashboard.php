<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>
<h1>Admin Dashboard</h1>
<div class="dashboard-stats">
    <h2>Statistics Overview</h2>
    <ul>
        <li>Total Clubs: <?php echo $totalClubs; ?></li>
        <li>Total Members: <?php echo $totalMembers; ?></li>
        <li>Total Applications: <?php echo $totalApplications; ?></li>
        <li>Total Events: <?php echo $totalEvents; ?></li>
    </ul>
</div>
<?php require_once 'views\common\footer.php'; ?>