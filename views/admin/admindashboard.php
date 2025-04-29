
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.8);
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255,255,255,.1);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255,255,255,.1);
        }
        .main-content {
            padding: 20px;
        }
        .stat-card {
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="p-3">
                    <h4 class="text-center mb-4">Explore Monde</h4>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-home me-2"></i> Tableau de Bord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="afficher.php">
                                <i class="fas fa-users me-2"></i> Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="affichvol.php">
                                <i class="fas fa-plane me-2"></i> vole
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-hotel me-2"></i> Hôtels
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-calendar-alt me-2"></i> Réservations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog me-2"></i> Paramètres
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Top Navigation -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                    <div class="container-fluid">
                        <span class="navbar-brand">Tableau de Bord</span>
                        <div class="d-flex align-items-center">
                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle me-2"></i><?= htmlspecialchars($_SESSION['admin_nom']) ?>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Paramètres</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Vos statistiques cards -->
                <div class="row g-4 mt-3">
                    <div class="col-md-6 col-lg-3">
                        <div class="card stat-card bg-primary text-white">
                            <div class="card-body">
                            <?php 
                            $totalClients = $conn->query("SELECT COUNT(*) FROM client")->fetchColumn();
                            ?>
                            <h5 class="card-title">Clients</h5>
                            <p class="display-6"><?= $totalClients ?></p>
                            <a href="../views/admin/afficher.php" class="text-white">Voir détails</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card stat-card bg-success text-white">
                            <div class="card-body">
                            <h5 class="card-title">Destinations</h5>
                            <?php 
                            $totalDestinations = $conn->query("SELECT COUNT(*) FROM destinations")->fetchColumn();
                            ?>
                            <p class="display-6"><?= $totalDestinations ?></p>
                            <a href="../views/admin/affichdes.php" class="text-white">Gérer</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card stat-card bg-info text-white">
                            <div class="card-body">
                            <h5 class="card-title">reservation</h5>
                              <?php 
                            $totalReservations = $conn->query("SELECT COUNT(*) FROM reservation")->fetchColumn();
                            ?>
                            <p class="display-6"><?= $totalReservations ?></p>
                            <a href="../views/admin/afficher2.php" class="text-white">Voir toutes</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card stat-card bg-warning text-dark">
                            <div class="card-body">
                                <h5 class="card-title">Vols</h5>
                                <?php 
                                $totalVols = $conn->query("SELECT COUNT(*) FROM vols")->fetchColumn();
                                ?>
                                <p class="display-6"><?= $totalVols ?></p>
                                <a href="../views/admin/affichvol.php" class="text-dark">Gérer vols</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                <h5>Dernières Réservations</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Client</th>
                                                <th>Destination</th>
                                                <th>Dates</th>
                                                <th>Voyageurs</th>
                                                <th>Statut</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
           
                                      if (!isset($reservations)) {
                                           $reservations = []; // Initialise une valeur par défaut
                                           }
                                         foreach ($reservations as $res): ?>
                                            <tr>
                                              <td><?= htmlspecialchars($res['nom']) ?></td>
                                              <td><?= htmlspecialchars($res['destination']) ?></td>
                                              <td>
                                              <?= date('d/m/Y', strtotime($res['datedepart'])) ?><br>
                                              <?= date('d/m/Y', strtotime($res['dateretour'])) ?>
                                              </td>
                                              <td><?= $res['nbvoyageurs'] ?></td>
                                              <td>
                                              <span class="badge bg-<?= 
                                             $res['statut'] === 'confirmée' ? 'success' : 
                                             ($res['statut'] === 'annulée' ? 'danger' : 'warning') 
                                               ?>">
                                             <?= ucfirst($res['statut']) ?>
                                             </span>
                                             </td>
                                             </tr>
                                             <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="../views/admin/afficher2.php" class="btn btn-primary mt-3">Voir toutes les réservations</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                <h5>Statistiques Rapides</h5>
                            </div>

                            <div class="card-body">
                            <?php
                              // Requêtes supplémentaires
                             $reservationsConfirmées = $conn->query("SELECT COUNT(*) FROM reservation WHERE statut = 'confirmée'")->fetchColumn();
                             $reservationsAnnulées = $conn->query("SELECT COUNT(*) FROM reservation WHERE statut = 'annulée'")->fetchColumn();
                             $destinationsPopulaires = $conn->query("
                             SELECT d.nom, COUNT(r.id_reservation) as nb_reservations
                             FROM destinations d
                             LEFT JOIN reservation r ON d.id_destination = r.id_destination
                             GROUP BY d.id_destination
                             ORDER BY nb_reservations DESC
                             LIMIT 3
                             ")->fetchAll();
                             ?>
                                <div class="mb-4">
                                <h6>Réservations</h6>
                                  <div class="progress mb-2">
                                     <div class="progress-bar bg-success" style="width: <?= ($reservationsConfirmées/$totalReservations)*100 ?>%">
                                      Confirmées (<?= $reservationsConfirmées ?>)
                                     </div>
                                     <div class="progress-bar bg-danger" style="width: <?= ($reservationsAnnulées/$totalReservations)*100 ?>%">
                                      Annulées (<?= $reservationsAnnulées ?>)
                                    </div>
                                 </div>
                                </div>

                                <div>
                                <h6>Destinations populaires</h6>
                                    <ul class="list-group">
                                     <?php foreach ($destinationsPopulaires as $dest): ?>
                                      <li class="list-group-item d-flex justify-content-between align-items-center">
                                           <?= htmlspecialchars($dest['nom']) ?>
                                           <span class="badge bg-primary rounded-pill"><?= $dest['nb_reservations'] ?></span>
                                        </li>
                                   <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Activer les tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>
</html>

<?php include('../../partials/footer.php'); ?>