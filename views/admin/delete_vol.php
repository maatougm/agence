<?php
include('../../config/connexion.php');

if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM vols WHERE id_vol = :id");
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            header('Location: affichvol.php?delete_success=1');
        } else {
            header('Location: affichvol.php?delete_error=1');
        }
    } catch (PDOException $e) {
        error_log("Error deleting flight: " . $e->getMessage());
        header('Location: affichvol.php?delete_error=1');
    }
} else {
    header('Location: affichvol.php');
}
?> 