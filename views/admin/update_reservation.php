<?php
include('../../config/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $id_reservation = $_POST['id_reservation'];
        $datedepart = $_POST['date_depart'];
        $dateretour = $_POST['date_retour'];
        $nbvoyageurs = $_POST['nombre_voyageurs'];
        $statut = $_POST['statut'];

        // Prepare and execute the update query
        $query = $conn->prepare("UPDATE reservation SET datedepart = ?, dateretour = ?, nbvoyageurs = ?, statut = ? WHERE id_reservation = ?");
        $result = $query->execute([$datedepart, $dateretour, $nbvoyageurs, $statut, $id_reservation]);

        if ($result) {
            // Redirect back to the reservations list with success message
            header("Location: afficher2.php?success=1");
            exit();
        } else {
            // Redirect back with error message
            header("Location: afficher2.php?error=1");
            exit();
        }
    } catch (PDOException $e) {
        // Log the error and redirect with error message
        error_log("Error updating reservation: " . $e->getMessage());
        header("Location: afficher2.php?error=1");
        exit();
    }
} else {
    // If not a POST request, redirect to the reservations list
    header("Location: afficher2.php");
    exit();
}
?> 