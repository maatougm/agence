<?php
// delete_action.php
session_start();
include '../../config/connexion.php';

// Vérifier que c'est bien une requête POST
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = "Méthode non autorisée";
    header("Location: afficher.php");
    exit();
}

// Vérifier que l'ID est présent et valide
if(!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    $_SESSION['error'] = "ID client invalide";
    header("Location: afficher.php");
    exit();
}

$id = (int)$_POST['id'];

try {
    // Vérifier d'abord que le client existe
    $check = $conn->prepare("SELECT id FROM client WHERE id = ?");
    $check->execute([$id]);
    
    if($check->rowCount() === 0) {
        $_SESSION['error'] = "Client introuvable";
        header("Location: afficher.php");
        exit();
    }

    // Supprimer le client avec une requête préparée
    $stmt = $conn->prepare("DELETE FROM client WHERE id = ?");
    $stmt->execute([$id]);
    
    $_SESSION['success'] = "Client supprimé avec succès";
    
} catch(PDOException $e) {
    $_SESSION['error'] = "Erreur lors de la suppression: " . $e->getMessage();
}

header("Location: afficher.php");
exit();
?>