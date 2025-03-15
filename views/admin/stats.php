<?php
// File: views/admin/stats.php
include 'views/layouts/header.php';
?>

<h1 class="mb-4">Statistiques</h1>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Nombre total d'étudiants</h5>
                <p class="display-4"><?php echo $stats['total_students']; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Nombre de clubs</h5>
                <p class="display-4"><?php echo $stats['total_clubs']; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Nombre de candidatures</h5>
                <p class="display-4"><?php echo $stats['total_applications']; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Candidatures par statut</h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Membres par club</h5>
            </div>
            <div class="card-body">
                <canvas id="clubMembersChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Statistiques détaillées par club</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom du Club</th>
                                <th>Membres</th>
                                <th>Candidatures</th>
                                <th>En attente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detailedStats as $club): ?>
                                <tr>
                                    <td><?php echo $club['name']; ?></td>
                                    <td><?php echo $club['members']; ?></td>
                                    <td><?php echo $club['applications']; ?></td>
                                    <td><?php echo $club['pending']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>
