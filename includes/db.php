<?php
/**
 * Database Connection File
 * 
 * This file establishes a connection to the MySQL database using PDO.
 * It includes error handling and sets the connection attributes.
 */

// Database configuration
$host = 'localhost';     // Database host
$dbname = 'exploremonde'; // Database name
$username = 'root';      // Database username
$password = '';          // Database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set PDO attributes
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error reporting
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Set default fetch mode
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Disable prepared statement emulation
    
} catch(PDOException $e) {
    // Log the error and display a user-friendly message
    error_log("Database Connection Error: " . $e->getMessage());
    die("Une erreur est survenue lors de la connexion à la base de données. Veuillez réessayer plus tard.");
} 