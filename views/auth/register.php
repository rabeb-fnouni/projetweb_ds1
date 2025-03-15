<?php
// File: views/auth/register.php
include 'views/layouts/header.php';
?>

<div class="card mx-auto" style="max-width: 500px;">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Inscription</h3>
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
        
        <form action="index.php?page=auth&action=register" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>
        </form>
        
        <div class="mt-3 text-center">
            <p>Vous avez déjà un compte ? <a href="index.php?page=auth&action=login">Connectez-vous</a></p>
        </div>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>