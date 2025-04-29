<?php
include('../../config/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id_vol = $_POST['id_vol'];
        $compagnie = $_POST['compagnie'];
        $numero_vol = $_POST['numero_vol'];
        $ville_depart = $_POST['ville_depart'];
        $ville_arrivee = $_POST['ville_arrivee'];
        $date_depart = $_POST['date_depart'];
        $date_arrivee = $_POST['date_arrivee'];
        $places = $_POST['places'];
        $prix = $_POST['prix'];

        $stmt = $conn->prepare("UPDATE vols SET 
                               compagnie = :compagnie,
                               numero_vol = :numero_vol,
                               ville_depart = :ville_depart,
                               ville_arrivee = :ville_arrivee,
                               date_depart = :date_depart,
                               date_arrivee = :date_arrivee,
                               places = :places,
                               prix = :prix
                               WHERE id_vol = :id_vol");

        $stmt->bindParam(':id_vol', $id_vol);
        $stmt->bindParam(':compagnie', $compagnie);
        $stmt->bindParam(':numero_vol', $numero_vol);
        $stmt->bindParam(':ville_depart', $ville_depart);
        $stmt->bindParam(':ville_arrivee', $ville_arrivee);
        $stmt->bindParam(':date_depart', $date_depart);
        $stmt->bindParam(':date_arrivee', $date_arrivee);
        $stmt->bindParam(':places', $places);
        $stmt->bindParam(':prix', $prix);

        if ($stmt->execute()) {
            header('Location: affichvol.php?success=1');
        } else {
            header('Location: affichvol.php?error=1');
        }
    } catch (PDOException $e) {
        error_log("Error updating flight: " . $e->getMessage());
        header('Location: affichvol.php?error=1');
    }
} else {
    header('Location: affichvol.php');
}
?> 