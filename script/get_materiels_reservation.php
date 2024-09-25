<?php
include 'db_connexion.php';  // Inclure la connexion PDO

try {
    // Requête SQL pour récupérer les matériels et leurs informations de réservation et de type
    $query = "
        SELECT 
    m.id, 
    m.nom_materiel, 
    m.status, 
    m.etat, 
    t.libelle_materiel,
    hr.date_debut, 
    hr.date_fin
FROM 
    materiel m
LEFT JOIN 
    type_materiel t ON m.fk_type_materiel = t.id
LEFT JOIN 
    historique_reservation hr ON m.id = hr.fk_materiel
    AND hr.date_fin = (
        SELECT MAX(hr2.date_fin) 
        FROM historique_reservation hr2 
        WHERE hr2.fk_materiel = m.id
    )
ORDER BY 
    m.nom_materiel;

    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $materiels = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'data' => $materiels]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la récupération des matériels.']);
}
?>
