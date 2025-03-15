<?php
// File: views/applications/apply.php
include 'views/layouts/header.php';
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Postuler au club <?php echo $club['name']; ?></h3>
    </div>
    <div class="card-body">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if (isset($application)): ?>
            <div class="alert alert-info">
                <p>Vous avez déjà postulé à ce club le <?php echo formatDate($application['created_at']); ?>.</p>
                <p>Statut: <?php echo getStatusBadge($application['status']); ?></p>
            </div>
            <a href="index.php?page=clubs&action=detail&id=<?php echo $club['id']; ?>" class="btn btn-primary">Retour aux détails du club</a>
        <?php else: ?>
            <form action="index.php?page=apply&action=submit" method="post" enctype="multipart/form-data">
                <input type="hidden" name="club_id" value="<?php echo $club['id']; ?>">
                
                <div class="mb-3">
                    <label for="motivation" class="form-label">Lettre de motivation</label>
                    <textarea class="form-control" id="motivation" name="motivation" rows="5" required></textarea>
                    <div class="form-text">Expliquez pourquoi vous souhaitez rejoindre ce club et ce que vous pouvez apporter.</div>
                </div>
                
                <div class="mb-3">
                    <label for="cv_file" class="form-label">CV (PDF ou Word)</label>
                    <input class="form-control" type="file" id="cv_file" name="cv_file" required>
                    <div class="form-text">Format accepté: PDF, Word (max 5MB)</div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="index.php?page=clubs&action=detail&id=<?php echo $club['id']; ?>" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Envoyer ma candidature</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>