<?php 
$pageTitle = 'Ajouter un Client';
include('../partials/header.php');
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Ajouter un nouveau client</h4>
                </div>
                <div class="card-body">
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

                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <textarea class="form-control" id="adresse" name="adresse" rows="3"></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="ville" class="form-label">Ville</label>
                                <input type="text" class="form-control" id="ville" name="ville">
                            </div>
                          

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="afficher.php" class="btn btn-secondary me-md-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Ajouter le client</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

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
</script>

<?php include('../partials/footer.php'); ?>