<?php require_once '../views/common/header.php'; ?>
<?php require_once '../views/common/navbar.php'; ?>

<div class="container">
    <h1>Delete Club</h1>

    <p>Are you sure you want to delete the club: <strong><?php echo htmlspecialchars($club->name); ?></strong>?</p>

    <form action="<?php echo BASE_URL; ?>/admin/deleteClub/<?php echo $club->id; ?>" method="POST">
        <div>
            <button type="submit" class="btn btn-danger">Yes, Delete Club</button>
            <a href="<?php echo BASE_URL; ?>/admin/clubs" class="btn">Cancel</a>
        </div>
    </form>
</div>

<?php require_once '../views/common/footer.php'; ?>