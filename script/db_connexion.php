<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mydil';

try {
    // Création d'une instance PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configuration de PDO pour afficher les erreurs sous forme d'exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Pas de sortie ici pour éviter tout conflit avec les réponses JSON
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
?>
