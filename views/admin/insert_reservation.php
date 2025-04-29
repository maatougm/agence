<?php
include('../../config/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $id_client = $_POST['id_client'];
        $id_destination = $_POST['id_destination'];
        $datedepart = $_POST['datedepart'];
        $dateretour = $_POST['dateretour'];
        $nbvoyageurs = $_POST['nbvoyageurs'];
        $prixtotal = $_POST['prixtotal'];
        $statut = $_POST['statut'];

        // Prepare and execute the insert query
        $query = $conn->prepare("INSERT INTO reservation (id_client, id_destination, datedepart, dateretour, nbvoyageurs, prixtotal, statut) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $result = $query->execute([$id_client, $id_destination, $datedepart, $dateretour, $nbvoyageurs, $prixtotal, $statut]);

        if ($result) {
            // Redirect back to the reservations list with success message
            header("Location: afficher2.php?add_success=1");
            exit();
        } else {
            // Redirect back with error message
            header("Location: afficher2.php?add_error=1");
            exit();
        }
    } catch (PDOException $e) {
        // Log the error and redirect with error message
        error_log("Error adding reservation: " . $e->getMessage());
        header("Location: afficher2.php?add_error=1");
        exit();
    }
} else {
    // If not a POST request, redirect to the form
    header("Location: forminsertion2.php");
    exit();
}
?> 