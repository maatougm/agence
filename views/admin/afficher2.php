<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réservations - ExploreMonde</title>
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
        .no-reservations {
            padding: 2rem;
            text-align: center;
            background-color: #f8f9fa;
            border-radius: 0.25rem;
        }
    </style>
</head>
<body>
    <?php 
    $pageTitle = 'Gestion des Réservations';
    include('../partials/header.php');
    include('../../config/connexion.php');

    // Check for success/error messages
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Réservation modifiée avec succès!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Une erreur est survenue lors de la modification de la réservation.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Réservation supprimée avec succès!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['delete_error']) && $_GET['delete_error'] == 1) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Une erreur est survenue lors de la suppression de la réservation.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    // Get all reservations with client and destination details
    $query = $conn->query("
        SELECT r.*, 
               c.nom as client_nom, c.prenom as client_prenom,
               d.nom as destination_nom, d.pays as destination_pays
        FROM reservation r
        LEFT JOIN client c ON r.id_client = c.id_client
        LEFT JOIN destinations d ON r.id_destination = d.id_destination
        ORDER BY r.datedepart DESC
    ");

    if($query) {
        $reservations = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo '<div class="alert alert-danger">Erreur de base de données</div>';
    }
    ?>

    <main class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des réservations</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReservationModal">
                <i class="fas fa-plus"></i> Ajouter une réservation
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Client</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Date de départ</th>
                        <th scope="col">Date de retour</th>
                        <th scope="col">Voyageurs</th>
                        <th scope="col">Prix total</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($reservations)): ?>
                    <?php foreach($reservations as $reservation): ?>
                    <tr>
                        <td><?= htmlspecialchars($reservation['client_nom'] . ' ' . $reservation['client_prenom']) ?></td>
                        <td><?= htmlspecialchars($reservation['destination_nom'] . ' (' . $reservation['destination_pays'] . ')') ?></td>
                        <td><?= date('d/m/Y', strtotime($reservation['datedepart'])) ?></td>
                        <td><?= date('d/m/Y', strtotime($reservation['dateretour'])) ?></td>
                        <td><?= htmlspecialchars($reservation['nbvoyageurs']) ?></td>
                        <td><?= number_format($reservation['prixtotal'], 2, ',', ' ') ?> €</td>
                        <td>
                            <span class="badge bg-<?= $reservation['statut'] == 'confirmée' ? 'success' : ($reservation['statut'] == 'en attente' ? 'warning' : 'danger') ?>">
                                <?= htmlspecialchars($reservation['statut']) ?>
                            </span>
                        </td>
                        <td class="table-actions">
                            <button type="button" class="btn btn-outline-primary btn-sm me-2 edit-reservation" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editReservationModal"
                                    data-id="<?= $reservation['id_reservation'] ?>"
                                    data-id-client="<?= $reservation['id_client'] ?>"
                                    data-id-destination="<?= $reservation['id_destination'] ?>"
                                    data-date-depart="<?= $reservation['datedepart'] ?>"
                                    data-date-retour="<?= $reservation['dateretour'] ?>"
                                    data-voyageurs="<?= $reservation['nbvoyageurs'] ?>"
                                    data-prix="<?= $reservation['prixtotal'] ?>"
                                    data-statut="<?= $reservation['statut'] ?>"
                                    title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="delete_reservation.php?id=<?= $reservation['id_reservation'] ?>" 
                               class="btn btn-outline-danger btn-sm" 
                               title="Supprimer"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="9" class="text-center py-4">
                                <div class="no-reservations">
                                    <i class="fas fa-calendar-times fa-3x mb-3 text-muted"></i>
                                    <h4>Aucune réservation trouvée</h4>
                                    <p class="text-muted">Commencez par ajouter une nouvelle réservation</p>
                                </div>
                              </td></tr>';
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Edit Reservation Modal -->
    <div class="modal fade" id="editReservationModal" tabindex="-1" aria-labelledby="editReservationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editReservationModalLabel">Modifier la réservation</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="update_reservation.php" method="POST" class="needs-validation" novalidate>
                        <input type="hidden" name="id_reservation" id="edit_id_reservation">
                        
                        <div class="mb-3">
                            <label for="edit_date_depart" class="form-label">Date de départ</label>
                            <input type="date" class="form-control" id="edit_date_depart" name="date_depart" required>
                            <div class="invalid-feedback">
                                Veuillez entrer une date de départ valide.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_date_retour" class="form-label">Date de retour</label>
                            <input type="date" class="form-control" id="edit_date_retour" name="date_retour" required>
                            <div class="invalid-feedback">
                                Veuillez entrer une date de retour valide.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_voyageurs" class="form-label">Nombre de voyageurs</label>
                            <input type="number" class="form-control" id="edit_voyageurs" name="nombre_voyageurs" min="1" required>
                            <div class="invalid-feedback">
                                Veuillez entrer un nombre de voyageurs valide.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_statut" class="form-label">Statut</label>
                            <select class="form-select" id="edit_statut" name="statut" required>
                                <option value="en attente">En attente</option>
                                <option value="confirmée">Confirmée</option>
                                <option value="annulée">Annulée</option>
                            </select>
                            <div class="invalid-feedback">
                                Veuillez sélectionner un statut.
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Reservation Modal -->
    <div class="modal fade" id="addReservationModal" tabindex="-1" aria-labelledby="addReservationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addReservationModalLabel">Ajouter une nouvelle réservation</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insert_reservation.php" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="id_client" class="form-label">Client</label>
                            <select class="form-select" id="id_client" name="id_client" required>
                                <option value="">Sélectionnez un client</option>
                                <?php foreach($clients as $client): ?>
                                    <option value="<?= $client['id_client'] ?>">
                                        <?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Veuillez sélectionner un client.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="id_destination" class="form-label">Destination</label>
                            <select class="form-select" id="id_destination" name="id_destination" required>
                                <option value="">Sélectionnez une destination</option>
                                <?php foreach($destinations as $destination): ?>
                                    <option value="<?= $destination['id_destination'] ?>">
                                        <?= htmlspecialchars($destination['nom'] . ' (' . $destination['pays'] . ')') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Veuillez sélectionner une destination.
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="datedepart" class="form-label">Date de départ</label>
                                <input type="date" class="form-control" id="datedepart" name="datedepart" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer une date de départ valide.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="dateretour" class="form-label">Date de retour</label>
                                <input type="date" class="form-control" id="dateretour" name="dateretour" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer une date de retour valide.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nbvoyageurs" class="form-label">Nombre de voyageurs</label>
                            <input type="number" class="form-control" id="nbvoyageurs" name="nbvoyageurs" min="1" required>
                            <div class="invalid-feedback">
                                Veuillez entrer un nombre de voyageurs valide.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="prixtotal" class="form-label">Prix total (€)</label>
                            <input type="number" class="form-control" id="prixtotal" name="prixtotal" step="0.01" min="0" required>
                            <div class="invalid-feedback">
                                Veuillez entrer un prix valide.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select class="form-select" id="statut" name="statut" required>
                                <option value="en attente">En attente</option>
                                <option value="confirmée">Confirmée</option>
                                <option value="annulée">Annulée</option>
                            </select>
                            <div class="invalid-feedback">
                                Veuillez sélectionner un statut.
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Ajouter la réservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('../partials/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });

        // Handle edit button click
        document.querySelectorAll('.edit-reservation').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const dateDepart = this.getAttribute('data-date-depart');
                const dateRetour = this.getAttribute('data-date-retour');
                const voyageurs = this.getAttribute('data-voyageurs');
                const statut = this.getAttribute('data-statut');

                document.getElementById('edit_id_reservation').value = id;
                document.getElementById('edit_date_depart').value = dateDepart;
                document.getElementById('edit_date_retour').value = dateRetour;
                document.getElementById('edit_voyageurs').value = voyageurs;
                document.getElementById('edit_statut').value = statut;
            });
        });
    });

    document.getElementById('datedepart').addEventListener('change', function() {
        const dateretour = document.getElementById('dateretour');
        if (this.value && dateretour.value && this.value > dateretour.value) {
            dateretour.setCustomValidity('La date de retour doit être postérieure à la date de départ');
        } else {
            dateretour.setCustomValidity('');
        }
    });

    document.getElementById('dateretour').addEventListener('change', function() {
        const datedepart = document.getElementById('datedepart');
        if (this.value && datedepart.value && this.value < datedepart.value) {
            this.setCustomValidity('La date de retour doit être postérieure à la date de départ');
        } else {
            this.setCustomValidity('');
        }
    });
    </script>
</body>
</html>