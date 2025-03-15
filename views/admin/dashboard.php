<?php
// File: views/admin/dashboard.php
include 'views/layouts/header.php';
?>

<h1 class="mb-4">Administration</h1>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Gestion des clubs</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Club</th>
                                <th>Membres</th>
                                <th>Candidatures</th>
                                <th>En attente</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clubStats as $club): ?>
                                <tr>
                                    <td><?php echo $club['name']; ?></td>
                                    <td><?php echo $club['member_count']; ?></td>
                                    <td><?php echo $club['application_count']; ?></td>
                                    <td><?php echo $club['pending_count']; ?></td>
                                    <td>
                                        <a href="index.php?page=clubs&action=detail&id=<?php echo $club['id']; ?>" class="btn btn-sm btn-primary">Voir</a>
                                    </td>
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