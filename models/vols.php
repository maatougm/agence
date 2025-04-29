<?php
// views/admin/vols.php

include ('../config/connexion.php');
include('../partials/header.php');

// Récupérer les vols depuis la base de données
try {
    $query = $conn->query('
        SELECT v.*, d.nom AS destination_nom 
        FROM vols v
        JOIN destinations d ON v.id_destination = d.id_destination
        ORDER BY v.date_depart DESC
    ');
    $vols = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $vols = [];
    $error_message = 'Erreur de base de données: ' . $e->getMessage();
}

// Récupérer les destinations pour le select
$destinations = $conn->query("SELECT * FROM destinations")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Vols - Explore Monde</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Gestion des Vols</h1>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>

        <!-- Formulaire d'ajout -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h2><i class="bi bi-airplane"></i> Ajouter un nouveau vol</h2>
            </div>
            <div class="card-body">
                <form action="../../controllers/vols/add_vol.php" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Compagnie aérienne</label>
                            <input type="text" class="form-control" name="compagnie" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Numéro de vol</label>
                            <input type="text" class="form-control" name="numero_vol" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Destination</label>
                            <select class="form-select" name="id_destination" required>
                                <option value="">Choisir une destination</option>
                                <?php foreach ($destinations as $dest): ?>
                                <option value="<?= htmlspecialchars($dest['id_destination']) ?>">
                                    <?= htmlspecialchars($dest['nom']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Ville de départ</label>
                            <input type="text" class="form-control" name="ville_depart" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date de départ</label>
                            <input type="datetime-local" class="form-control" name="date_depart" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date d'arrivée</label>
                            <input type="datetime-local" class="form-control" name="date_arrivee" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nombre de places</label>
                            <input type="number" class="form-control" name="places" min="1" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Prix (€)</label>
                            <input type="number" class="form-control" name="prix" min="0" step="0.01" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ville d'arrivée</label>
                            <input type="text" class="form-control" name="ville_arrivee" required>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary" name="ajouter_vol">
                                <i class="bi bi-save"></i> Enregistrer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Liste des vols -->
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h2><i class="bi bi-list-ul"></i> Liste des vols programmés</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Compagnie</th>
                                <th>Numéro</th>
                                <th>Itinéraire</th>
                                <th>Dates</th>
                                <th>Places</th>
                                <th>Prix</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($vols)): ?>
                                <?php foreach ($vols as $vol): ?>
                                <tr>
                                    <td><?= htmlspecialchars($vol['compagnie']) ?></td>
                                    <td><?= htmlspecialchars($vol['numero_vol']) ?></td>
                                    <td>
                                        <?= htmlspecialchars($vol['ville_depart']) ?> 
                                        <i class="bi bi-arrow-right"></i> 
                                        <?= htmlspecialchars($vol['ville_arrivee']) ?>
                                    </td>
                                    <td>
                                        <small>
                                            Départ: <?= date('d/m/Y H:i', strtotime($vol['date_depart'])) ?><br>
                                            Arrivée: <?= date('d/m/Y H:i', strtotime($vol['date_arrivee'])) ?>
                                        </small>
                                    </td>
                                    <td><?= htmlspecialchars($vol['places']) ?></td>
                                    <td><?= number_format($vol['prix'], 2) ?> €</td>
                                    <td>
                                        <a href="edit_vol.php?id=<?= $vol['id_vol'] ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="../../controllers/vols/delete_vol.php?id=<?= $vol['id_vol'] ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce vol ?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        Aucun vol trouvé dans la base de données
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include('../partials/footer.php'); ?>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>