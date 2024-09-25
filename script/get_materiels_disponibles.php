<?php
// Inclure le fichier de connexion à la base de données
include 'db_connexion.php';

// Vérifier si un type de matériel a été fourni
$typeId = isset($_GET['typeId']) ? $_GET['typeId'] : '';

// Préparer la requête SQL
$query = "SELECT DISTINCT materiel.id, materiel.nom_materiel, materiel.status, materiel.etat, type_materiel.libelle_materiel, materiel.description 
          FROM materiel
          JOIN type_materiel ON materiel.fk_type_materiel = type_materiel.id
          WHERE materiel.status = 'Disponible'";

// Ajouter une condition si un type de matériel est sélectionné
if (!empty($typeId)) {
    $query .= " AND materiel.fk_type_materiel = :typeId";
}

try {
    // Préparer et exécuter la requête
    $stmt = $pdo->prepare($query);

    // Si un type de matériel est sélectionné, lier la valeur à la requête
    if (!empty($typeId)) {
        $stmt->bindParam(':typeId', $typeId, PDO::PARAM_INT);
    }

    $stmt->execute();

    // Récupérer les résultats sous forme de tableau associatif
    $materiels = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si des matériels ont été trouvés
    if ($materiels) {
        // Retourner les données sous forme de JSON
        echo json_encode([
            'status' => 'success',
            'data' => $materiels
        ]);
    } else {
        // Aucun matériel trouvé
        echo json_encode([
            'status' => 'error',
            'message' => 'Aucun matériel disponible trouvé.'
        ]);
    }
} catch (PDOException $e) {
    // En cas d'erreur, retourner un message d'erreur
    echo json_encode([
        'status' => 'error',
        'message' => 'Erreur lors de la récupération des matériels : ' . $e->getMessage()
    ]);
}
?>
