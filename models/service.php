<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset=utf-8>
	<title>Explore monde</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="agence de voyage">
	<meta name="keywords" content="treveling,voyage,agence de voyage">
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
    <!-- Header -->
    <header>
        <h1>Nos Services</h1>
        <p>Explore Monde vous offre une gamme complète de services pour transformer vos rêves de voyage en réalité.</p>
        <?php include  '../views/partials/header.php'; ?>
    </header>

    <!-- Section des Services -->
    <section id="services">
        <h2>Nos Services</h2>
        <div class="services-grid">
            <!-- Service 1 -->
            <div class="service-card">
                <img src="../assets/images/1.jpg" alt="Réservation de voyage" width="150">
                <h3>Réservation de Voyage</h3>
                <p>Accédez à des tarifs exclusifs sur les vols, les hôtels et les activités dans le monde entier.</p>
                <button onclick="window.location.href='contact.html'">Contactez-nous</button>
            </div>
            <!-- Service 2 -->
            <div class="service-card">
                <img src="../assets/images/map.jpg" alt="Guides locaux" width="150">
                <h3>Guides Locaux</h3>
                <p>Découvrez les destinations comme un local grâce à nos guides expérimentés et passionnés.</p>
                <button onclick="window.location.href='blog.html#guides'">En savoir plus</button>
            </div>
            <!-- Service 3 -->
            <div class="service-card">
                <img src="../assets/images/3.jpg" alt="Forfaits personnalisés" width="150">
                <h3>Forfaits Personnalisés</h3>
                <p>Que vous cherchiez l'aventure ou la détente, nos forfaits s'adaptent à vos besoins.</p>
                <button onclick="window.location.href='destinations.html#forfaits'">Voir nos forfaits</button>
            </div>
            <!-- Service 4 -->
            <div class="service-card">
                <img src="../assets/images/service.jpg" alt="Assistance 24/7" width="150">
                <h3>Assistance 24/7</h3>
                <p>Voyagez en toute sérénité avec notre service client disponible jour et nuit.</p>
                <button onclick="window.location.href='contact.html'">Appelez-nous</button>
            </div>
        </div>
    </section>

    <!-- Témoignages -->
    <section id="testimonials">
        <h2>Ce que nos clients disent</h2>
        <div class="testimonial">
            <p>"Explore Monde a transformé nos vacances en une expérience magique. Merci pour votre professionnalisme !"</p>
            <h4>- Sarah & Mehdi</h4>
        </div>
        <div class="testimonial">
            <p>"Les guides locaux ont rendu notre séjour inoubliable. Nous avons découvert des trésors cachés que seuls les locaux connaissent."</p>
            <h4>- Karim</h4>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq">
        <h2>Questions Fréquemment Posées</h2>
        <details>
            <summary>Comment réserver un voyage avec Explore Monde ?</summary>
            <p>Vous pouvez réserver directement sur notre site ou en contactant notre équipe via la page Contact.</p>
        </details>
        <details>
            <summary>Proposez-vous des réductions pour les groupes ?</summary>
            <p>Oui, nous offrons des tarifs avantageux pour les groupes de 5 personnes ou plus.</p>
        </details>
        <details>
            <summary>Que se passe-t-il si j'ai besoin d'aide pendant mon voyage ?</summary>
            <p>Notre assistance 24/7 est toujours disponible pour répondre à vos besoins en voyage.</p>
        </details>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Explore Monde. Tous droits réservés.</p>
        <p>Suivez-nous sur : 
            <a href="https://facebook.com">Facebook</a> | 
            <a href="https://instagram.com">Instagram</a> | 
            <a href="https://twitter.com">Twitter</a>
        </p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
 
</body>
</html>

