<?php
header('Content-Type: application/json; charset=UTF-8');

// Inclure la connexion à la base de données
include 'db_connexion.php';

try {
    // Préparer la requête pour récupérer tous les matériels
    $sql = "SELECT DISTINCT m.id, nom_materiel, libelle_materiel, description FROM materiel m,type_materiel t WHERE m.fk_type_materiel=t.id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Si des résultats existent
    if ($result) {
        echo json_encode([
            'status' => 'success',
            'data' => $result
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Aucun matériel trouvé.'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Erreur de requête : ' . $e->getMessage()
    ]);
}
?>
