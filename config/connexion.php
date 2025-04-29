<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=agence_de_voyage;charset=utf8mb4', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(Exception $e) {
    die('Erreur de connexion: ' . $e->getMessage());
}

?>