<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
    exit;
}

header('Content-Type: application/json'); 

include 'db_connexion.php'; 

$id = $_POST['id'];
$nom = $_POST['nom'];
$type = $_POST['type'];
$description = $_POST['description'];


// Vérifier que tous les champs sont présents et complet
if (!empty($id) && !empty($nom) && !empty($type)) {
    try {
        // Préparer la requête de mise à jour du materiel
        $query = "UPDATE materiel SET nom_materiel = :nom, fk_type_materiel = :type, description = :description WHERE id = :id";
        $stmt = $pdo->prepare($query);
        
        // Exécuter la requête avec les données envoyées
        $stmt->execute([
            ':nom' => $nom,
            ':type' => $type,
            ':description' => $description,
            ':id' => $id
        ]);

        // Si la requête a réussi
        echo json_encode(['status' => 'success', 'message' => 'Materiel mis a jour avec succes.']);
        error_log("Mise à jour réussie pour l'ID : $id");
    } catch (PDOException $e) {
        // En cas d'erreur d'exécution de la requête
        error_log("Erreur lors de l'exécution de la requête : " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la mise à jour du materiel.']);
    }
} else {
    // Si tous les champs ne sont pas remplis
    error_log("Tous les champs ne sont pas remplis.");
    echo json_encode(['status' => 'error', 'message' => 'Tous les champs sont requis.']);
}
?>
