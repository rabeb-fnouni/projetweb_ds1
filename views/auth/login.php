<?php
// File: views/auth/login.php
include 'views/layouts/header.php';
?>

<div class="card mx-auto" style="max-width: 500px;">
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Connexion</h3>
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
        
        <form action="index.php?page=auth&action=login" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </form>
        
        <div class="mt-3 text-center">
            <p>Vous n'avez pas de compte ? <a href="index.php?page=auth&action=register">Inscrivez-vous</a></p>
        </div>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>