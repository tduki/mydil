<?php
// Vérifier si la méthode est POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
    exit;
}

include 'db_connexion.php';  // Inclure la connexion à la base de données

// Récupérer les données POST
$id = $_POST['id'];
$status = $_POST['status'];

// Vérifier que les données sont présentes
if (!empty($id) && !empty($status)) {
    try {
        // Mettre à jour le statut du matériel dans la base de données
        $query = "UPDATE materiel SET status = :status WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':status' => $status,
            ':id' => $id
        ]);
        echo json_encode(['status' => 'success', 'message' => 'Status du matériel mis à jour avec succès.']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la mise à jour du statut.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Tous les champs sont requis.']);
}
?>
