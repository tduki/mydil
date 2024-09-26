<?php
include("db_connexion.php");

try {
    // preparer la requête de selection
    $sql = "SELECT * FROM type_materiel";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // recuperer tous les resultats
    $types = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // retourner les resultats en format JSON
    echo json_encode(['status' => 'success', 'data' => $types]);
} catch (PDOException $e) {
    // Si une erreur survient, retourner une réponse JSON avec l'erreur
    echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la récupération des types de matériel : ' . $e->getMessage()]);
}
?>
