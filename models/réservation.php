<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation - Explore Monde</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('images/hero-bg.jpg') center/cover;
            color: white;
            padding: 8rem 0;
            text-align: center;
        }

        .destination-card {
            transition: transform 0.3s;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .destination-card:hover {
            transform: translateY(-10px);
        }

        .newsletter-section {
            background: #f8f9fa;
            padding: 4rem 0;
        }
    </style>
</head>
<body>
<?php include  '../views/partials/header.php'; ?>
    <!-- Formulaire de Réservation -->
    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="reservation-card p-5">
                    <h2 class="text-center mb-5">Réservez votre voyage</h2>
                    
                    <form id="reservationForm">
                        <div class="row g-4">
                            <!-- Informations Personnelles -->
                            <div class="col-md-6 form-section">
                                <h4 class="mb-4">Informations personnelles</h4>
                                
                                <div class="mb-3">
                                    <label class="form-label">Nom complet</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" pattern="[0-9]{8}" required>
                                </div>
                            </div>

                            <!-- Détails du Voyage -->
                            <div class="col-md-6">
                                <h4 class="mb-4">Détails du voyage</h4>
                                
                                <div class="mb-3">
                                    <label class="form-label">Destination</label>
                                    <select class="form-select" required>
                                        <option value="">Choisir...</option>
                                        <option>Maldives</option>
                                        <option>Sydney</option>
                                        <option>Rome</option>
                                        <option>Paris</option>
                                        <option>Tokyo</option>
                                    </select>
                                </div>
                                
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label">Date de départ</label>
                                        <input type="date" class="form-control" id="departureDate" required>
                                    </div>
                                    
                                    <div class="col-6">
                                        <label class="form-label">Date de retour</label>
                                        <input type="date" class="form-control" id="returnDate" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3 mt-4">
                                    <label class="form-label">Nombre de voyageurs</label>
                                    <input type="number" class="form-control" min="1" max="10" value="1" required>
                                </div>
                            </div>

                            <!-- Bouton de Soumission -->
                            <div class="col-12 text-center mt-4">
                              
                                <a href="paiement.html" class="btn btn-primary px-5 py-2">
                                    Confirmer la réservation
                                </a>
                           
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <?php include  '../views/partials/footer.php'; ?>
</body>
</html>