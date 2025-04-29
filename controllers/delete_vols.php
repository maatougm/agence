<?php
require '../../config/connexion.php';
require '../../models/vols.php';

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../../login.php');
    exit;
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_vol = (int)$_GET['id'];
    
    if (deleteVol($pdo, $id_vol)) {
        $_SESSION['message'] = "Vol supprimé avec succès";
    } else {
        $_SESSION['error'] = "Erreur lors de la suppression";
    }
}

header('Location: ../../views/admin/vols.php');
exit;
?>