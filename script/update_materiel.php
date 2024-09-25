<?php
// Vérifier si la méthode est POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
    exit;
}

header('Content-Type: application/json');  // Spécifie que la réponse renvoyée est du JSON
include 'db_connexion.php';  // Inclure la connexion PDO

// Récupérer les données envoyées via POST
$id = $_POST['id'];
$nom = $_POST['nom'];
$type = $_POST['type'];
$description = $_POST['description'];

// Log les données reçues (utile pour le débogage)
error_log("Données reçues : ID = $id, Nom = $nom, Type = $type, Description = $description");

// Vérifier que tous les champs sont présents
if (!empty($id) && !empty($nom) && !empty($type)) {
    try {
        // Préparer la requête de mise à jour avec PDO
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
