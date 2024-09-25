<?php
include 'db_connexion.php'; // Inclure la connexion à la base de données

header('Content-Type: application/json');

try {
    // Requête pour récupérer tous les utilisateurs avec leur groupe
    $query = "
        SELECT 
            identifiants.id, 
            identifiants.nom, 
            identifiants.prenom, 
            identifiants.email, 
            type_user.libelle_type_user AS groupe 
        FROM identifiants
        JOIN type_user ON identifiants.fk_type_user = type_user.id
        ORDER BY identifiants.nom ASC
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retourner les utilisateurs sous forme de JSON
    echo json_encode(['status' => 'success', 'data' => $users]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la récupération des utilisateurs.']);
}
?>
