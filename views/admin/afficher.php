<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
        .client-table {
            font-family: Arial, sans-serif;
            margin: 20px auto;
            width: 95%;
            border-collapse: collapse;
        }
        .client-table th {
            background-color: #343a40;
            color: white;
            padding: 12px;
            text-align: center;
        }
        .client-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }
        .client-table tr:hover {
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
    $pageTitle = 'Gestion des Clients';
    include('../partials/header.php');
    include('../../config/connexion.php');

    // Check for success/error messages
    if (isset($_GET['add_success']) && $_GET['add_success'] == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Client ajouté avec succès!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['add_error']) && $_GET['add_error'] == 1) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Une erreur est survenue lors de l\'ajout du client.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Client modifié avec succès!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Une erreur est survenue lors de la modification du client.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Client supprimé avec succès!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['delete_error']) && $_GET['delete_error'] == 1) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Une erreur est survenue lors de la suppression du client.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    if (isset($_GET['error']) && $_GET['error'] == 'client_not_found') {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Client introuvable.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }

    $query = $conn->query('SELECT id_client, nom, prenom, email, numtel FROM client');

    if($query) {
        $clients = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo '<div class="alert alert-danger">Aucune donnée trouvée</div>';
    }
    ?>

    <div class="container mt-4">
        <h1 class="mb-4">Gestion des Clients</h1>
        
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addClientModal">
            <i class="bi bi-plus-circle"></i> Ajouter un client
        </button>
        
        <?php if(!empty($clients)): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>E-mail</th>
                        <th>Téléphone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clients as $client): ?>
                    <tr>
                        <td><?= htmlspecialchars($client['nom']) ?></td>
                        <td><?= htmlspecialchars($client['prenom']) ?></td>
                        <td><?= htmlspecialchars($client['email']) ?></td>
                        <td><?= htmlspecialchars($client['numtel']) ?></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm action-btn edit-client" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editClientModal"
                                    data-id="<?= $client['id_client'] ?>"
                                    data-nom="<?= htmlspecialchars($client['nom']) ?>"
                                    data-prenom="<?= htmlspecialchars($client['prenom']) ?>"
                                    data-email="<?= htmlspecialchars($client['email']) ?>"
                                    data-numtel="<?= htmlspecialchars($client['numtel']) ?>"
                                    title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <a href="delete_form.php?id=<?= $client['id_client'] ?>" 
                               class="btn btn-danger btn-sm action-btn" 
                               title="Supprimer"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="alert alert-info">Aucun client trouvé dans la base de données</div>
        <?php endif; ?>
    </div>

    <!-- Add Client Modal -->
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addClientModalLabel">Ajouter un nouveau client</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insertion.php" method="POST" class="needs-validation" novalidate>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer le nom du client.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer le prénom du client.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">
                                Veuillez entrer une adresse email valide.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="numtel" class="form-label">Numéro de téléphone</label>
                            <input type="tel" class="form-control" id="numtel" name="numtel" required>
                            <div class="invalid-feedback">
                                Veuillez entrer un numéro de téléphone valide.
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Ajouter le client</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Client Modal -->
    <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editClientModalLabel">Modifier le client</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="modifierpersonne.php" method="POST" class="needs-validation" novalidate>
                        <input type="hidden" name="id_client" id="edit_id_client">
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="edit_nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="edit_nom" name="nom" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer le nom du client.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="edit_prenom" name="prenom" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer le prénom du client.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                            <div class="invalid-feedback">
                                Veuillez entrer une adresse email valide.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_numtel" class="form-label">Numéro de téléphone</label>
                            <input type="tel" class="form-control" id="edit_numtel" name="numtel" required>
                            <div class="invalid-feedback">
                                Veuillez entrer un numéro de téléphone valide.
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
        document.querySelectorAll('.edit-client').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nom = this.getAttribute('data-nom');
                const prenom = this.getAttribute('data-prenom');
                const email = this.getAttribute('data-email');
                const numtel = this.getAttribute('data-numtel');

                document.getElementById('edit_id_client').value = id;
                document.getElementById('edit_nom').value = nom;
                document.getElementById('edit_prenom').value = prenom;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_numtel').value = numtel;
            });
        });
    });
    </script>
</body>
</html>