<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Vols - Explore Monde</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .table-actions {
            white-space: nowrap;
        }
        .table-actions .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .table-actions .btn i {
            margin-right: 0;
        }
        .card-header {
            padding: 1rem 1.5rem;
        }
    </style>
</head>
<body>
    <?php 
    $pageTitle = 'Gestion des Vols';
    include('../partials/header.php');
    include('../../config/connexion.php');

    // Check for success/error messages
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Vol modifié avec succès!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Une erreur est survenue lors de la modification du vol.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Vol supprimé avec succès!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['delete_error']) && $_GET['delete_error'] == 1) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Une erreur est survenue lors de la suppression du vol.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    // Get all flights
    $query = $conn->query("SELECT * FROM vols ORDER BY date_depart DESC");
    if($query) {
        $vols = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo '<div class="alert alert-danger">Erreur de base de données</div>';
    }
    ?>

    <main class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des vols</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVolModal">
                <i class="fas fa-plus"></i> Ajouter un vol
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Compagnie</th>
                        <th>Numéro de vol</th>
                        <th>Départ</th>
                        <th>Arrivée</th>
                        <th>Date départ</th>
                        <th>Date arrivée</th>
                        <th>Places</th>
                        <th>Prix</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($vols)): ?>
                        <?php foreach($vols as $vol): ?>
                            <tr>
                                <td><?= htmlspecialchars($vol['compagnie']) ?></td>
                                <td><?= htmlspecialchars($vol['numero_vol']) ?></td>
                                <td><?= htmlspecialchars($vol['ville_depart']) ?></td>
                                <td><?= htmlspecialchars($vol['ville_arrivee']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($vol['date_depart'])) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($vol['date_arrivee'])) ?></td>
                                <td><?= htmlspecialchars($vol['places']) ?></td>
                                <td><?= number_format($vol['prix'], 2, ',', ' ') ?> €</td>
                                <td class="table-actions">
                                    <button type="button" class="btn btn-outline-primary btn-sm me-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editVolModal<?= $vol['id_vol'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteVolModal<?= $vol['id_vol'] ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Modal for each flight -->
                            <div class="modal fade" id="editVolModal<?= $vol['id_vol'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modifier le vol</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="update_vol.php" method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_vol" value="<?= $vol['id_vol'] ?>">
                                                <div class="mb-3">
                                                    <label class="form-label">Compagnie</label>
                                                    <input type="text" class="form-control" name="compagnie" value="<?= htmlspecialchars($vol['compagnie']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Numéro de vol</label>
                                                    <input type="text" class="form-control" name="numero_vol" value="<?= htmlspecialchars($vol['numero_vol']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Ville de départ</label>
                                                    <input type="text" class="form-control" name="ville_depart" value="<?= htmlspecialchars($vol['ville_depart']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Ville d'arrivée</label>
                                                    <input type="text" class="form-control" name="ville_arrivee" value="<?= htmlspecialchars($vol['ville_arrivee']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Date de départ</label>
                                                    <input type="datetime-local" class="form-control" name="date_depart" value="<?= date('Y-m-d\TH:i', strtotime($vol['date_depart'])) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Date d'arrivée</label>
                                                    <input type="datetime-local" class="form-control" name="date_arrivee" value="<?= date('Y-m-d\TH:i', strtotime($vol['date_arrivee'])) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nombre de places</label>
                                                    <input type="number" class="form-control" name="places" value="<?= htmlspecialchars($vol['places']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Prix</label>
                                                    <input type="number" step="0.01" class="form-control" name="prix" value="<?= htmlspecialchars($vol['prix']) ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal for each flight -->
                            <div class="modal fade" id="deleteVolModal<?= $vol['id_vol'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Supprimer le vol</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Êtes-vous sûr de vouloir supprimer ce vol ?</p>
                                            <p><strong>Compagnie:</strong> <?= htmlspecialchars($vol['compagnie']) ?></p>
                                            <p><strong>Numéro de vol:</strong> <?= htmlspecialchars($vol['numero_vol']) ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <form action="delete_vol.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="id_vol" value="<?= $vol['id_vol'] ?>">
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <div class="no-flights">
                                    <i class="fas fa-plane-slash fa-3x mb-3 text-muted"></i>
                                    <h4>Aucun vol trouvé</h4>
                                    <p class="text-muted">Commencez par ajouter un nouveau vol</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Add Flight Modal -->
    <div class="modal fade" id="addVolModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un nouveau vol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="insert_vol.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Compagnie</label>
                            <input type="text" class="form-control" name="compagnie" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Numéro de vol</label>
                            <input type="text" class="form-control" name="numero_vol" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ville de départ</label>
                            <input type="text" class="form-control" name="ville_depart" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ville d'arrivée</label>
                            <input type="text" class="form-control" name="ville_arrivee" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date de départ</label>
                            <input type="datetime-local" class="form-control" name="date_depart" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date d'arrivée</label>
                            <input type="datetime-local" class="form-control" name="date_arrivee" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre de places</label>
                            <input type="number" class="form-control" name="places" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prix</label>
                            <input type="number" step="0.01" class="form-control" name="prix" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('../partials/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add date validation
        document.addEventListener('DOMContentLoaded', function() {
            const dateInputs = document.querySelectorAll('input[type="datetime-local"]');
            dateInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const departureInput = this.name === 'date_depart' ? this : 
                        this.closest('form').querySelector('input[name="date_depart"]');
                    const arrivalInput = this.name === 'date_arrivee' ? this : 
                        this.closest('form').querySelector('input[name="date_arrivee"]');
                    
                    if (departureInput && arrivalInput) {
                        const departureDate = new Date(departureInput.value);
                        const arrivalDate = new Date(arrivalInput.value);
                        
                        if (arrivalDate <= departureDate) {
                            alert('La date d\'arrivée doit être postérieure à la date de départ');
                            this.value = '';
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>