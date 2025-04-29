<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Meta tags for character encoding and responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Dynamic page title -->
    <title><?= isset($pageTitle) ? $pageTitle . ' - ' : '' ?>Explore Monde</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom styles -->
    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .nav-link {
            color: rgba(255,255,255,.85);
        }
        .nav-link:hover {
            color: #fff;
        }
        /* Sidebar styles */
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            color: #fff;
            padding-top: 1rem;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.75);
            padding: 0.75rem 1rem;
            margin: 0.25rem 0;
            border-radius: 0.25rem;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,.1);
        }
        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff;
        }
        .sidebar .nav-link i {
            margin-right: 0.5rem;
            width: 1.25rem;
            text-align: center;
        }
        .main-content {
            padding: 2rem;
        }
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Explore Monde</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/EXPLORE%20MONDE/index.php">
                                <i class="fas fa-home"></i> Accueil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/EXPLORE%20MONDE/views/destinations.php">
                                <i class="fas fa-map-marked-alt"></i> Destinations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/EXPLORE%20MONDE/views/contact.php">
                                <i class="fas fa-envelope"></i> Contact
                            </a>
                        </li>
                        <?php if(isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/EXPLORE%20MONDE/views/admin/afficher.php">
                                    <i class="fas fa-users"></i> Gestion Clients
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/EXPLORE%20MONDE/views/admin/affichdes.php">
                                    <i class="fas fa-map-marker-alt"></i> Gestion Destinations
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/EXPLORE%20MONDE/views/admin/afficher2.php">
                                    <i class="fas fa-calendar-check"></i> Gestion Réservations
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/EXPLORE%20MONDE/views/admin/affichvol.php">
                                    <i class="fas fa-plane"></i> Gestion Vols
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/EXPLORE%20MONDE/controllers/logout.php">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/EXPLORE%20MONDE/views/connexion.php">
                                    <i class="fas fa-sign-in-alt"></i> Connexion
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/EXPLORE%20MONDE/views/inscription.php">
                                    <i class="fas fa-user-plus"></i> Inscription
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Top navigation -->
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <span class="navbar-text text-white">
                                        <?= isset($pageTitle) ? $pageTitle : 'Tableau de bord' ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Bootstrap JavaScript -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    // Highlight active link in sidebar
                    document.addEventListener('DOMContentLoaded', function() {
                        const currentPath = window.location.pathname;
                        const navLinks = document.querySelectorAll('.sidebar .nav-link');
                        
                        navLinks.forEach(link => {
                            if (link.getAttribute('href') === currentPath) {
                                link.classList.add('active');
                            }
                        });
                    });
                </script>
            </main>
        </div>
    </div>
</body>
</html> 