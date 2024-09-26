<?php
include 'db_connexion.php'; 

session_start();

header('Content-Type: application/json'); 

$user_id = $_SESSION['user_id']; // Récupérer l'ID de l'utilisateur connecté

if ($user_id) {
    try {
        // Requête pour récupérer les réservations de l'utilisateur
        $query = " SELECT m.nom_materiel, tm.libelle_materiel AS type_materiel, hr.date_debut, hr.date_fin, hr.raison 
            FROM historique_reservation hr
            JOIN materiel m ON hr.fk_materiel = m.id
            JOIN type_materiel tm ON m.fk_type_materiel = tm.id
            WHERE hr.fk_personne = :user_id
            ORDER BY hr.date_debut DESC ";


        $stmt = $pdo->prepare($query);
        $stmt->execute(['user_id' => $user_id]);
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retourner les réservations en JSON
        echo json_encode(['status' => 'success', 'data' => $reservations]);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la récupération des réservations.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Utilisateur non connecté.']);
}
?>
