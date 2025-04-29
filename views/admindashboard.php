<?php 
$pageTitle = 'Tableau de Bord Admin';
include 'partials/header.php'; 
?>

<div class="container mt-4">
    <h1 class="mb-4">Tableau de Bord Administrateur</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Clients</h5>
                    <h2 class="card-text"><?= $clientsCount ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Réservations</h5>
                    <h2 class="card-text"><?= $reservationsCount ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Destinations</h5>
                    <h2 class="card-text"><?= $voyagesCount ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Revenus Totaux</h5>
                    <h2 class="card-text"><?= number_format($revenus, 2) ?> €</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Activité Récente -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Activité Récente</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Statut</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($activites as $activite): ?>
                            <tr>
                                <td><?= htmlspecialchars($activite['nom']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $activite['statut'] === 'confirmée' ? 'success' : 'warning' ?>">
                                        <?= htmlspecialchars($activite['statut']) ?>
                                    </span>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($activite['date_creation'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Actions Rapides -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Actions Rapides</h5>
                    <div class="d-grid gap-2">
                        <a href="controllers/ajouter_destination.php" class="btn btn-primary">Ajouter une Destination</a>
                        <a href="controllers/gerer_reservations.php" class="btn btn-secondary">Gérer les Réservations</a>
                        <a href="controllers/gerer_clients.php" class="btn btn-info">Gérer les Clients</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?> 