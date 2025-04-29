<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Inclure la connexion à la base de données
include('../config/connexion.php');

// Récupérer les statistiques et données
try {
    // Récupérer les dernières réservations
    $stmt = $conn->query("
        SELECT r.*, c.nom, d.nom as destination
        FROM reservation r
        JOIN client c ON r.id_client = c.id_client
        JOIN destinations d ON r.id_destination = d.id_destination
        ORDER BY r.date_reservation DESC
        LIMIT 5
    ");
    $reservations = $stmt->fetchAll();

} catch (PDOException $e) {
    $error = "Erreur lors de la récupération des données: " . $e->getMessage();
    $reservations = [];
}

// Inclure la vue
include('../views/admin/admindashboard.php'); 