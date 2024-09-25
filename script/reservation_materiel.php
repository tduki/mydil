<?php
include 'db_connexion.php';
session_start();

header('Content-Type: application/json'); // S'assurer que la réponse est en JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idMateriel = $_POST['id_materiel'];
    $dateDebut = $_POST['date_debut'];
    $dateFin = $_POST['date_fin'];
    $raison = $_POST['raison'];
    $userId = $_SESSION['user_id'];  // Assurez-vous que l'ID de l'utilisateur est stocké dans la session

    if (!empty($idMateriel) && !empty($dateDebut) && !empty($dateFin) && !empty($raison) && !empty($userId)) {
        try {
            // Mettre à jour le matériel comme "Réservé"
            $updateStatusQuery = "UPDATE materiel SET status = 'Réservé' WHERE id = :id";
            $stmt = $pdo->prepare($updateStatusQuery);
            $stmt->execute(['id' => $idMateriel]);

            // Ajouter la réservation dans l'historique
            $insertQuery = "INSERT INTO historique_reservation (date_debut, date_fin, raison, fk_materiel, fk_personne) VALUES (:dateDebut, :dateFin, :raison, :fk_materiel, :fk_personne)";
            $stmt = $pdo->prepare($insertQuery);
            $stmt->execute([
                'dateDebut' => $dateDebut,
                'dateFin' => $dateFin,
                'raison' => $raison,
                'fk_materiel' => $idMateriel,
                'fk_personne' => $userId
            ]);

            // Réponse JSON de succès
            echo json_encode(['status' => 'success', 'message' => 'Réservation effectuée.']);
        } catch (PDOException $e) {
            // En cas d'erreur PDO
            error_log($e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la réservation.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Tous les champs doivent être remplis.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée.']);
}
?>
