<?php
$pageTitle = 'Ajouter une Réservation';
include('../partials/header.php');
include('../../config/connexion.php');

// Get clients and destinations for dropdowns
$clientsQuery = $conn->query("SELECT id_client, nom, prenom FROM client ORDER BY nom");
$destinationsQuery = $conn->query("SELECT id_destination, nom, pays FROM destinations ORDER BY nom");

$clients = $clientsQuery->fetchAll(PDO::FETCH_ASSOC);
$destinations = $destinationsQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Ajouter une nouvelle réservation</h4>
                </div>
                <div class="card-body">
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

                        <div class="d-flex justify-content-between">
                            <a href="afficher2.php" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-primary">Ajouter la réservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Form validation
(function() {
    'use strict';
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
})();

// Date validation
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

<?php include('../partials/footer.php'); ?>