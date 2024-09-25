<?php
include 'db_connexion.php';  // Connexion à la base de données

header('Content-Type: application/json');  // S'assurer que la réponse est bien en JSON

try {
    $query = "SELECT id, libelle_materiel FROM type_materiel";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $types = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'data' => $types]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la récupération des types de matériel.']);
}
?>
