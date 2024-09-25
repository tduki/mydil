<?php
include 'db_connexion.php';  

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $group = $_POST['group'];

    if (!empty($id) && !empty($group)) {
        try {
            // Requête pour mettre à jour le groupe d'utilisateur
            $updateQuery = "UPDATE identifiants SET fk_type_user = :group WHERE id = :id";
            $stmt = $pdo->prepare($updateQuery);
            $stmt->execute(['group' => $group, 'id' => $id]);

            echo json_encode(['status' => 'success', 'message' => 'Groupe d\'utilisateur mis à jour avec succès.']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la mise à jour du groupe d\'utilisateur.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Les champs ID et groupe sont requis.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée.']);
}
?>
