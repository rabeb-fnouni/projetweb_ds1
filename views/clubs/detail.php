<?php
// File: views/clubs/detail.php
include 'views/layouts/header.php';
?>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Votre demande d'adhésion a été envoyée avec succès !
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card mb-4">
    <div class="row g-0">
        <div class="col-md-4">
            <?php if ($club['logo']): ?>
                <img src="public/images/clubs/<?php echo $club['logo']; ?>" class="img-fluid rounded-start" alt="<?php echo $club['name']; ?>">
            <?php else: ?>
                <div class="text-center p-5 bg-light h-100 d-flex align-items-center justify-content-center">
                    <i class="fas fa-users fa-5x text-secondary"></i>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h2 class="card-title"><?php echo $club['name']; ?></h2>
                <p class="card-text"><small class="text-muted">Fondé le <?php echo formatDate($club['foundation_date']); ?></small></p>
                <p class="card-text"><?php echo nl2br($club['description']); ?></p>
                
                <h5 class="mt-4">Membres</h5>
                <p class="card-text"><strong><?php echo $memberCount; ?></strong> membres actifs</p>
                
                <h5 class="mt-4">Réseaux sociaux</h5>
                <div class="social-links">
                    <?php if ($club['social_facebook']): ?>
                        <a href="<?php echo $club['social_facebook']; ?>" target="_blank" class="me-3">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($club['social_instagram']): ?>
                        <a href="<?php echo $club['social_instagram']; ?>" target="_blank" class="me-3">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($club['social_twitter']): ?>
                        <a href="<?php echo $club['social_twitter']; ?>" target="_blank" class="me-3">
                            <i class="fab fa-twitter fa-2x"></i>
                        </a>
                    <?php endif; ?>
                </div>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php 
                    $hasApplied = hasApplied($_SESSION['user_id'], $club['id']);
                    $status = $hasApplied ? getApplicationStatus($_SESSION['user_id'], $club['id']) : '';
                    ?>
                    
                    <?php if ($hasApplied): ?>
                        <div class="mt-4 alert alert-info">
                            Votre demande d'adhésion est <?php echo getStatusBadge($status); ?>
                        </div>
                    <?php else: ?>
                        <div class="mt-4">
                            <a href="index.php?page=apply&club_id=<?php echo $club['id']; ?>" class="btn btn-primary">Postuler à ce club</a>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="mt-4 alert alert-warning">
                        <a href="index.php?page=auth&action=login" class="alert-link">Connectez-vous</a> ou <a href="index.php?page=auth&action=register" class="alert-link">inscrivez-vous</a> pour postuler à ce club.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>