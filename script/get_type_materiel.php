<?php
// Inclure le fichier de connexion à la base de données
include("db_connexion.php");

try {
    // Préparer la requête de sélection
    $sql = "SELECT * FROM type_materiel";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Récupérer tous les résultats
    $types = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retourner les résultats en format JSON
    echo json_encode(['status' => 'success', 'data' => $types]);
} catch (PDOException $e) {
    // Si une erreur survient, retourner une réponse JSON avec l'erreur
    echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la récupération des types de matériel : ' . $e->getMessage()]);
}
?>
