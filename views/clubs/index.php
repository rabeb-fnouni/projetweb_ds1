<?php
// File: views/clubs/index.php
include 'views/layouts/header.php';
?>

<h1 class="mb-4">Nos Clubs</h1>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($clubs as $club): ?>
        <div class="col">
            <div class="card h-100">
                <?php if ($club['logo']): ?>
                    <img src="public/images/clubs/<?php echo $club['logo']; ?>" class="card-img-top" alt="<?php echo $club['name']; ?>">
                <?php else: ?>
                    <div class="text-center p-5 bg-light">
                        <i class="fas fa-users fa-4x text-secondary"></i>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $club['name']; ?></h5>
                    <p class="card-text"><?php echo substr($club['description'], 0, 100); ?>...</p>
                </div>
                <div class="card-footer">
                    <a href="index.php?page=clubs&action=detail&id=<?php echo $club['id']; ?>" class="btn btn-primary">Voir détails</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php
include 'views/layouts/footer.php';
?>