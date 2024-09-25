<?php
include 'db_connexion.php';

$typeId = $_GET['typeId'] ?? null;

if ($typeId) {
    // Récupérer les matériels en fonction du type
    $query = "SELECT id, nom_materiel FROM materiel WHERE fk_type_materiel = :typeId";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['typeId' => $typeId]);

    $materiels = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Si des matériels sont trouvés, les renvoyer
    if ($materiels) {
        echo json_encode(['status' => 'success', 'data' => $materiels]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Aucun matériel trouvé.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Type de matériel non fourni.']);
}
?>
