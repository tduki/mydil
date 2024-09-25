<?php
// Activer les erreurs PHP pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');  // Toujours envoyer un JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Inclure la connexion à la base de données
    include 'db_connexion.php';  // Vérifiez bien que ce chemin est correct

    // Récupérer les données envoyées en POST
    $id = $_POST['id'];
    $status = $_POST['status'];

    if (!empty($id) && !empty($status)) {
        try {
            // Requête pour mettre à jour le statut du matériel
            $query = "UPDATE materiel SET status = :status WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':status' => $status, ':id' => $id]);

            echo json_encode(['status' => 'success', 'message' => 'Status mis à jour avec succès']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la mise à jour du statut']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tous les champs sont obligatoires']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
}
?>
