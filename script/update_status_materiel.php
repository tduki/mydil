<?php

header('Content-Type: application/json');  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    include 'db_connexion.php';  

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
