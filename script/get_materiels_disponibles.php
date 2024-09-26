<?php
include 'db_connexion.php';

// verifier si un type de materiel a ete fourni
$typeId = isset($_GET['typeId']) ? $_GET['typeId'] : '';

//requete sql pour voir le materiel disponible
$query = "SELECT DISTINCT materiel.id, materiel.nom_materiel, materiel.status, materiel.etat, type_materiel.libelle_materiel, materiel.description 
          FROM materiel
          JOIN type_materiel ON materiel.fk_type_materiel = type_materiel.id
          WHERE materiel.status = 'Disponible'";

// ajouter une condition si un type de matériel est sélectionne
if (!empty($typeId)) {
    $query .= " AND materiel.fk_type_materiel = :typeId";
}

try {
    // preparer et exécuter la requete
    $stmt = $pdo->prepare($query);

    // si un type de materiel est sélectionné, lier la valeur à la requete
    if (!empty($typeId)) {
        $stmt->bindParam(':typeId', $typeId, PDO::PARAM_INT);
    }

    $stmt->execute();

    // recuperer les resultats sous forme de tableau associatif
    $materiels = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // verifier si des matériels ont été trouvés
    if ($materiels) {
        // retourner les donnees sous forme de JSON
        echo json_encode([
            'status' => 'success',
            'data' => $materiels
        ]);
    } else {
        // Aucun materiel trouve
        echo json_encode([
            'status' => 'error',
            'message' => 'Aucun matériel disponible trouvé.'
        ]);
    }
} catch (PDOException $e) {
    // en cas d'erreur, retourner un message d'erreur
    echo json_encode([
        'status' => 'error',
        'message' => 'Erreur lors de la récupération des matériels : ' . $e->getMessage()
    ]);
}
?>
