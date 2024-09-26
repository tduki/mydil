<?php
include 'db_connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $typeNom = isset($_POST['typeNom']) ? $_POST['typeNom'] : null;

   
    if ($id && $typeNom) {
        try {
            // Préparer la requête de mise à jour
            $sql = "UPDATE type_materiel SET libelle_materiel = :typeNom WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':typeNom', $typeNom);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Mise à jour réussie']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la mise à jour']);
            }
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Erreur SQL : ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Paramètres manquants']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
}
?>
