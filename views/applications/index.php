<?php require_once 'views\common\header.php'; ?>
<?php require_once 'views\common\navbar.php'; ?>

<div class="container">
    <h1>Your Applications</h1>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="flash-message <?php echo $_SESSION['flash_message']['type']; ?>">
            <?php echo $_SESSION['flash_message']['message']; ?>
            <?php unset($_SESSION['flash_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($applications)): ?>
        <table>
            <thead>
                <tr>
                    <th>Club</th>
                    <th>CV</th>
                    <th>Motivation</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $application): ?>
                    <tr>
                        <td><?php echo $application->club_name; ?></td>
                        <td>
                            <a href="<?php echo BASE_URL . 'public\uploads\cv' . $application->cv_file; ?>" target="_blank">View CV</a>
                        </td>
                        <td><?php echo htmlspecialchars($application->motivation); ?></td>
                        <td><?php echo ucfirst($application->status); ?></td>
                        <td>
                            <?php if ($application->status === 'pending'): ?>
                                <a href="<?php echo BASE_URL; ?>views\applications\cancel<?php echo $application->id; ?>">Cancel Application</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have not submitted any applications yet.</p>
    <?php endif; ?>
</div>

<?php require_once 'views\common\footer.php'; ?>