<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Vol - Explore Monde</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php 
    $pageTitle = 'Ajouter un Vol';
    include('../partials/header.php');
    ?>

    <main class="container mt-4">
        <div class="form-container">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Ajouter un nouveau vol</h4>
                </div>
                <div class="card-body">
                    <form action="insert_vol.php" method="POST" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="compagnie" class="form-label">Compagnie aérienne</label>
                                <input type="text" class="form-control" id="compagnie" name="compagnie" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer le nom de la compagnie.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="numero_vol" class="form-label">Numéro de vol</label>
                                <input type="text" class="form-control" id="numero_vol" name="numero_vol" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer le numéro de vol.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="ville_depart" class="form-label">Ville de départ</label>
                                <input type="text" class="form-control" id="ville_depart" name="ville_depart" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer la ville de départ.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="ville_arrivee" class="form-label">Ville d'arrivée</label>
                                <input type="text" class="form-control" id="ville_arrivee" name="ville_arrivee" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer la ville d'arrivée.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_depart" class="form-label">Date et heure de départ</label>
                                <input type="datetime-local" class="form-control" id="date_depart" name="date_depart" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer la date et l'heure de départ.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_arrivee" class="form-label">Date et heure d'arrivée</label>
                                <input type="datetime-local" class="form-control" id="date_arrivee" name="date_arrivee" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer la date et l'heure d'arrivée.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="places" class="form-label">Nombre de places</label>
                                <input type="number" class="form-control" id="places" name="places" min="1" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer un nombre de places valide.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="prix" class="form-label">Prix (€)</label>
                                <input type="number" class="form-control" id="prix" name="prix" step="0.01" min="0" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer un prix valide.
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="affichvol.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Ajouter le vol
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include('../partials/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // Date validation
        document.getElementById('date_depart').addEventListener('change', function() {
            const dateArrivee = document.getElementById('date_arrivee');
            if (this.value && dateArrivee.value && this.value > dateArrivee.value) {
                dateArrivee.setCustomValidity('La date d\'arrivée doit être postérieure à la date de départ');
            } else {
                dateArrivee.setCustomValidity('');
            }
        });

        document.getElementById('date_arrivee').addEventListener('change', function() {
            const dateDepart = document.getElementById('date_depart');
            if (this.value && dateDepart.value && this.value < dateDepart.value) {
                this.setCustomValidity('La date d\'arrivée doit être postérieure à la date de départ');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html> 