<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Explore Monde</title>
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
        <h1>Explorez le Monde à Travers Nos Articles</h1>
        <p>Découvrez des conseils, des astuces et des récits de voyages qui vous inspireront pour vos prochaines aventures.</p>
        <?php include  '../views/partials/header.php'; ?>
    </header>

    <!-- Section Blog -->
    <section id="blog">
        <h2>Nos Derniers Articles</h2>

        <!-- Article 1 -->
        <article class="blog-post">
            <h3><a href="#paris-section">Visiter Paris : La Ville de l'Amour</a></h3>
            <p class="meta">Publié le 12 Janvier 2025 | Par Explore Monde</p>
            <p class="excerpt">Découvrez les lieux incontournables de Paris, de la Tour Eiffel à Montmartre, et comment vivre l'expérience de la ville la plus romantique au monde...</p>
        </article>

        <!-- Article 2 -->
        <article class="blog-post">
            <h3><a href="#bali-section">Bali : Un Paradis Tropical Incontournable</a></h3>
            <p class="meta">Publié le 5 Janvier 2025 | Par Explore Monde</p>
            <p class="excerpt">Bali est une destination idéale pour les amateurs de plages, de temples et de paysages luxuriants. Découvrez pourquoi c'est l'endroit rêvé pour vos vacances...</p>
        </article>

        <!-- Section dédiée à Paris -->
        <section id="paris-section" class="full-article">
            <h2>Visiter Paris : La Ville de l'Amour</h2>
            <img src="../assets/images/paris.jpg" alt="Tour Eiffel à Paris" class="img-zoom img-fade" width="200" />
            <p>Paris est la capitale de la France, célèbre pour sa culture, son histoire, et son charme intemporel. C'est l'une des villes les plus visitées au monde, offrant une variété de monuments emblématiques tels que la Tour Eiffel, le Louvre et la Cathédrale Notre-Dame.</p>
            <h3>Les Lieux Incontournables</h3>
            <ul>
                <li><strong>La Tour Eiffel</strong> - Un symbole de l'ingéniosité française et un incontournable de tout voyage à Paris.</li>
                <li><strong>Le Musée du Louvre</strong> - Le musée le plus visité du monde, abritant des œuvres iconiques comme la Joconde.</li>
                <li><strong>Montmartre</strong> - Le quartier bohème de Paris, célèbre pour ses artistes et ses vues magnifiques sur la ville.</li>
            </ul>
            <h3>Conseils pour les Voyageurs</h3>
            <ul>
                <li>Utilisez le métro pour vous déplacer rapidement à travers la ville.</li>
                <li>Essayez les croissants et autres pâtisseries dans un café parisien traditionnel.</li>
                <li>Visitez les monuments tôt le matin ou tard dans la soirée pour éviter les foules.</li>
            </ul>
        </section>

        <!-- Section dédiée à Bali -->
        <section id="bali-section" class="full-article">
            <h2>Bali : Un Paradis Tropical Incontournable</h2>
            <img src="../assets/images/bali.jpg" alt="Plages de Bali" class="img-zoom img-fade" width="200" />
            <p>Bali est l’une des destinations les plus populaires au monde, offrant des paysages exotiques, une culture riche et une atmosphère détendue. Découvrez ce qui rend cette île si spéciale.</p>
            <ul>
                <li><strong>Les Plages</strong> - Profitez des plages de sable blanc et de l'eau cristalline pour vous détendre ou pratiquer des sports nautiques.</li>
                <li><strong>Les Temples</strong> - Bali est riche en temples hindous historiques à explorer.</li>
                <li><strong>Les Rizières en Terrasses</strong> - Un paysage pittoresque et apaisant, parfait pour des randonnées dans la nature.</li>
            </ul>
        </section>
    </section>

    <footer>
        <p>&copy; 2025 Explore Monde. Tous droits réservés.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <?php include  '../views/partials/footer.php'; ?>
</body>
</html>


