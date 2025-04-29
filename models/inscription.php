<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - ExploreMonde</title>
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
    <!-- Navigation -->
    <?php include  '../views/partials/header.php'; ?>
    <!-- Formulaire d'inscription -->
    <section class="registration-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="registration-card p-5">
                        <h2 class="text-center mb-4">Créez votre compte</h2>
                         <form id="registrationForm" action="../../views/admin/traitement_inscription.php" method="POST">
                            <!-- Formulaire -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="lastName" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="firstName" required>
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Adresse email</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input type="password" class="form-control" id="password" minlength="8" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="confirmPassword" class="form-label">Confirmez le mot de passe</label>
                                    <input type="password" class="form-control" id="confirmPassword" required>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" required>
                                        <label class="form-check-label" for="terms">J'accepte les <a href="#" class="text-primary">conditions d'utilisation</a></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100 py-2">S'inscrire maintenant</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
