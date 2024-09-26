<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
    exit;
}

include 'db_connexion.php'; 

// Récupérer les données 
$nom_materiel = $_POST['nom'] ?? null;
$type_materiel = $_POST['type'] ?? null;
$description = $_POST['description'] ?? null;

// valeurs par défaut pour status et etat dispo apres la création
$status = 'Disponible';
$etat = 'disponible';

// Vérifier que les données requises sont présentes
if (!empty($nom_materiel) && !empty($type_materiel) && !empty($description)) {
    try {
        // Préparer la requête d'insertion
        $query = "INSERT INTO materiel (nom_materiel, fk_type_materiel, description, status, etat) 
                  VALUES (:nom_materiel, :fk_type_materiel, :description, :status, :etat)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':nom_materiel' => $nom_materiel,
            ':fk_type_materiel' => $type_materiel,
            ':description' => $description,
            ':status' => $status,
            ':etat' => $etat
        ]);

        echo json_encode(['status' => 'success', 'message' => 'Matériel ajouté avec succès.']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'insertion du matériel : ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Tous les champs sont requis.']);
}
?>
