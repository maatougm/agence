<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Inclure la connexion à la base de données et l'en-tête

include('../config/connexion.php');

// Récupérer les statistiques
try {
    // Nombre de clients
    $stmt = $conn->query("SELECT COUNT(*) as total FROM client");
    $clientsCount = $stmt->fetch()['total'];

    // Nombre de réservations
    $stmt = $conn->query("SELECT COUNT(*) as total FROM reservation");
    $reservationsCount = $stmt->fetch()['total'];

    // Nombre de destinations (remplace voyages)
    $stmt = $conn->query("SELECT COUNT(*) as total FROM destinations");
    $voyagesCount = $stmt->fetch()['total'];

    // Revenus totaux (supposant que vous avez un champ prix dans reservation)
    $stmt = $conn->query("SELECT SUM(prix) as total FROM reservation");
    $revenus = $stmt->fetch()['total'] ?? 0;

    // Activité récente
    $activites = $conn->query("
        SELECT r.id_reservation, 
               CONCAT(c.prenom, ' ', c.nom) AS nom_client,
               d.nom AS destination,
               r.datedepart,
               r.dateretour,
               r.nbvoyageurs,
               r.statut
        FROM reservation r
        JOIN client c ON r.id_client = c.id
        JOIN destinations d ON r.id_destination = d.id_destination
        ORDER BY r.datedepart DESC
        LIMIT 5
    ")->fetchAll();

} catch (PDOException $e) {
    // En cas d'erreur, utiliser des valeurs par défaut
    $clientsCount = 0;
    $reservationsCount = 0;
    $voyagesCount = 0;
    $revenus = 0;
    $activites = [];
    // Vous pourriez aussi logger l'erreur: error_log($e->getMessage());
}

// Inclure la vue
include('../views/admin/admindashboard.php');
?>