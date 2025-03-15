<?php
// File: views/layouts/footer.php
?>
    </div>
    
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>ESSECT Clubs</h5>
                    <p>Plateforme de gestion des clubs universitaires de l'ESSECT.</p>
                </div>
                <div class="col-md-3">
                    <h5>Liens</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white">Accueil</a></li>
                        <li><a href="index.php?page=clubs" class="text-white">Clubs</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <address>
                        ESSECT<br>
                        4 Rue Abou Zakaria El Hafsi<br>
                        1089 Montfleury, Tunis<br>
                        <i class="fas fa-envelope me-2"></i> contact@essect.edu.tn<br>
                        <i class="fas fa-phone me-2"></i> +216 71 330 266
                    </address>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> ESSECT. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/main.js"></script>
</body>
</html>