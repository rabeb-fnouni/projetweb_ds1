<?php
// File: views/home.php
include 'views/layouts/header.php';
?>

<div class="jumbotron bg-light p-5 rounded">
    <h1 class="display-4">Bienvenue sur la plateforme des clubs de l'ESSECT</h1>
    <p class="lead">Découvrez nos clubs universitaires et rejoignez celui qui vous correspond !</p>
    <hr class="my-4">
    <p>Explorez les clubs, leurs activités et postulez directement en ligne.</p>
    <a class="btn btn-primary btn-lg" href="index.php?page=clubs" role="button">Découvrir les clubs</a>
</div>

<div class="row mt-5">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                <h3 class="card-title">Rejoindre un club</h3>
                <p class="card-text">Faites partie d'une communauté dynamique et enrichissante en rejoignant un club qui vous passionne.</p>
                <a href="index.php?page=clubs" class="btn btn-outline-primary">Voir les clubs</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <i class="fas fa-lightbulb fa-3x mb-3 text-primary"></i>
                <h3 class="card-title">Développer vos compétences</h3>
                <p class="card-text">Nos clubs vous offrent l'opportunité de développer de nouvelles compétences et d'enrichir votre parcours.</p>
                <a href="index.php?page=clubs" class="btn btn-outline-primary">Découvrir</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <i class="fas fa-handshake fa-3x mb-3 text-primary"></i>
                <h3 class="card-title">Élargir votre réseau</h3>
                <p class="card-text">Rencontrez d'autres étudiants passionnés et créez des connexions qui dureront tout au long de votre carrière.</p>
                <a href="index.php?page=clubs" class="btn btn-outline-primary">En savoir plus</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Clubs à la une</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="public/images/clubs/enactus.jpg" class="card-img-top" alt="Enactus">
                            <div class="card-body">
                                <h5 class="card-title">Enactus</h5>
                                <p class="card-text">Enactus est une organisation étudiante qui développe des projets d'entrepreneuriat social.</p>
                                <a href="index.php?page=clubs&action=detail&id=1" class="btn btn-sm btn-primary">En savoir plus</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="public/images/clubs/infolab.jpg" class="card-img-top" alt="InfoLab">
                            <div class="card-body">
                                <h5 class="card-title">InfoLab</h5>
                                <p class="card-text">InfoLab est le club d'informatique qui organise des formations, des hackathons et des événements tech.</p>
                                <a href="index.php?page=clubs&action=detail&id=2" class="btn btn-sm btn-primary">En savoir plus</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="public/images/clubs/radio.jpg" class="card-img-top" alt="Radio ESSECT">
                            <div class="card-body">
                                <h5 class="card-title">Radio ESSECT</h5>
                                <p class="card-text">La radio étudiante qui anime la vie de campus et donne la parole aux étudiants.</p>
                                <a href="index.php?page=clubs&action=detail&id=3" class="btn btn-sm btn-primary">En savoir plus</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>