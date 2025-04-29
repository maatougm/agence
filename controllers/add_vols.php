<?php
require '../../config/connexion.php';
require '../../models/vols.php';

// Vérifier si l'admin est connecté
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'compagnie' => $_POST['compagnie'],
        'numero_vol' => $_POST['numero_vol'],
        'id_destination' => $_POST['id_destination'],
        'ville_depart' => $_POST['ville_depart'],
        'ville_arrivee' => $_POST['ville_arrivee'],
        'date_depart' => $_POST['date_depart'],
        'date_arrivee' => $_POST['date_arrivee'],
        'places' => $_POST['places'],
        'prix' => $_POST['prix']
    ];

    if (addVol($pdo, $data)) {
        $_SESSION['message'] = "Vol ajouté avec succès";
        header('Location: ../../views/admin/vols.php');
    } else {
        $_SESSION['error'] = "Erreur lors de l'ajout du vol";
        header('Location: ../../views/admin/vols.php');
    }
    exit;
}
?>