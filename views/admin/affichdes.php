<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
        .destination-table {
            font-family: Arial, sans-serif;
            margin: 20px auto;
            width: 95%;
            border-collapse: collapse;
        }
        .destination-table th {
            background-color: #343a40;
            color: white;
            padding: 12px;
            text-align: center;
        }
        .destination-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }
        .destination-table tr:hover {
            background-color: #f5f5f5;
        }
        .action-btn {
            margin: 0 3px;
            padding: 5px 10px;
        }
        .footer {
            text-align: right;
            margin-top: 20px;
            font-style: italic;
            color: #666;
        }
    </style>
</head>  
<body>   
    <?php
    $pageTitle = 'Gestion des Destinations';
    include('../partials/header.php');
    include('../../config/connexion.php');

    // Check for success/error messages
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Destination modifiée avec succès!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Une erreur est survenue lors de la modification de la destination.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Destination supprimée avec succès!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['delete_error']) && $_GET['delete_error'] == 1) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Une erreur est survenue lors de la suppression de la destination.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    $query = $conn->query('SELECT id_destination, nom, pays, description, prix FROM destinations');

    if($query) {
        $destinations = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo '<div class="alert alert-danger">Aucune donnée trouvée</div>';
    }
    ?>

    <div class="container mt-4">
        <h1 class="mb-4">Gestion des Destinations</h1>
        
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addDestinationModal">
            <i class="bi bi-plus-circle"></i> Ajouter une destination
        </button>
        
        <?php if(!empty($destinations)): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Pays</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($destinations as $destination): ?>
                    <tr>
                        <td><?= htmlspecialchars($destination['nom']) ?></td>
                        <td><?= htmlspecialchars($destination['pays']) ?></td>
                        <td><?= htmlspecialchars($destination['description']) ?></td>
                        <td><?= number_format($destination['prix'], 2, ',', ' ') ?> €</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm action-btn edit-destination" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editDestinationModal"
                                    data-id="<?= $destination['id_destination'] ?>"
                                    data-nom="<?= htmlspecialchars($destination['nom']) ?>"
                                    data-pays="<?= htmlspecialchars($destination['pays']) ?>"
                                    data-description="<?= htmlspecialchars($destination['description']) ?>"
                                    data-prix="<?= $destination['prix'] ?>"
                                    title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <a href="delete_destination.php?id=<?= $destination['id_destination'] ?>" 
                               class="btn btn-danger btn-sm action-btn" 
                               title="Supprimer"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette destination ?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="alert alert-info">Aucune destination trouvée dans la base de données</div>
        <?php endif; ?>
    </div>

    <!-- Add Destination Modal -->
    <div class="modal fade" id="addDestinationModal" tabindex="-1" aria-labelledby="addDestinationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addDestinationModalLabel">Ajouter une nouvelle destination</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insert_destination.php" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                            <div class="invalid-feedback">
                                Veuillez entrer le nom de la destination.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pays" class="form-label">Pays</label>
                            <input type="text" class="form-control" id="pays" name="pays" required>
                            <div class="invalid-feedback">
                                Veuillez entrer le pays.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            <div class="invalid-feedback">
                                Veuillez entrer une description.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix (€)</label>
                            <input type="number" class="form-control" id="prix" name="prix" step="0.01" required>
                            <div class="invalid-feedback">
                                Veuillez entrer un prix valide.
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Ajouter la destination</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Destination Modal -->
    <div class="modal fade" id="editDestinationModal" tabindex="-1" aria-labelledby="editDestinationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editDestinationModalLabel">Modifier la destination</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="update_destination.php" method="POST" class="needs-validation" novalidate>
                        <input type="hidden" name="id_destination" id="edit_id_destination">
                        
                        <div class="mb-3">
                            <label for="edit_nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="edit_nom" name="nom" required>
                            <div class="invalid-feedback">
                                Veuillez entrer le nom de la destination.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_pays" class="form-label">Pays</label>
                            <input type="text" class="form-control" id="edit_pays" name="pays" required>
                            <div class="invalid-feedback">
                                Veuillez entrer le pays.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                            <div class="invalid-feedback">
                                Veuillez entrer une description.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_prix" class="form-label">Prix (€)</label>
                            <input type="number" class="form-control" id="edit_prix" name="prix" step="0.01" required>
                            <div class="invalid-feedback">
                                Veuillez entrer un prix valide.
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

    <div class="footer container">
        DS - Explore Monde
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    if(isset($query)) {
        $query->closeCursor(); 
    }
    include('../partials/footer.php');
    ?>

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
        document.querySelectorAll('.edit-destination').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nom = this.getAttribute('data-nom');
                const pays = this.getAttribute('data-pays');
                const description = this.getAttribute('data-description');
                const prix = this.getAttribute('data-prix');

                document.getElementById('edit_id_destination').value = id;
                document.getElementById('edit_nom').value = nom;
                document.getElementById('edit_pays').value = pays;
                document.getElementById('edit_description').value = description;
                document.getElementById('edit_prix').value = prix;
            });
        });
    });
    </script>
</body>
</html>