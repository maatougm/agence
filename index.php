<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Monde - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
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
<?php 
$pageTitle = 'Accueil';
include 'views/partials/header.php'; 
?>

    <!-- Section Hero -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 mb-4">L'aventure commence ici</h1>
            <p class="lead mb-4">Découvrez des destinations uniques avec nos experts</p>
            <a href= "https://www.tourdumondiste.com/meilleurs-pays-a-visiter" class="btn btn-lg btn-light ">Explorer maintenant</a>
        </div>
    </section>

    <!-- Destinations Phares -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Nos destinations populaires</h2>
            
            <div class="gallery-grid">
                <div class="row g-4">
                    <!-- Paris -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card destination-card h-100">
                            <img src="assets/images/paris.jpg" class="card-img-top" alt="Paris">
                            <div class="card-body">
                                <h5 class="card-title">Paris, France</h5>
                                <p class="card-text">La ville lumière et ses monuments iconiques</p>
                                <a href="#" class="btn btn-primary btn-sm">À partir de 800€</a>
                            </div>
                        </div>
                    </div>
    
                    <!-- New York -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card destination-card h-100">
                            <img src="assets/images/newyork.jpg" class="card-img-top" alt="New York">
                            <div class="card-body">
                                <h5 class="card-title">New York, USA</h5>
                                <p class="card-text">L'énergie unique de la Grosse Pomme</p>
                                <a href="#" class="btn btn-primary btn-sm">À partir de 1200€</a>
                            </div>
                        </div>
                    </div>
    
                    <!-- Tokyo -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card destination-card h-100">
                            <img src="assets/images/tokyo.jpg" class="card-img-top" alt="Tokyo">
                            <div class="card-body">
                                <h5 class="card-title">Tokyo, Japon</h5>
                                <p class="card-text">Tradition et modernité en harmonie</p>
                                <a href="#" class="btn btn-primary btn-sm">À partir de 1500€</a>
                            </div>
                        </div>
                    </div>
    
                    <!-- Bali -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card destination-card h-100">
                            <img src="assets/images/bali.jpg" class="card-img-top" alt="Bali">
                            <div class="card-body">
                                <h5 class="card-title">Bali, Indonésie</h5>
                                <p class="card-text">Paradis tropical aux paysages enchanteurs</p>
                                <a href="#" class="btn btn-primary btn-sm">À partir de 900€</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- Newsletter -->
    <section class="newsletter-section">
        <div class="container text-center">
            <h2 class="mb-4">Ne manquez aucune offre</h2>
            <p class="mb-4">Abonnez-vous à notre newsletter pour des promotions exclusives</p>
            
            <form class="row g-3 justify-content-center">
                <div class="col-auto">
                    <input type="email" class="form-control" placeholder="Votre email">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">S'abonner</button>
                </div>
            </form>
        </div>
    </section>

<?php include 'views/partials/footer.php'; ?>
</body>
</html>