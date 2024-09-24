<?php
// Inclure le fichier de connexion à la base de données
include("db_connexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_log("Requête AJAX reçue");  // Ajouter ceci pour voir si le serveur reçoit la requête

    // Vérifier si le champ typeNom est défini
    if (isset($_POST['typeNom']) && !empty($_POST['typeNom'])) {
        // Récupérer la valeur du typeNom
        $typeNom = trim($_POST['typeNom']);
        error_log("Nom du type : " . $typeNom);  // Log pour vérifier la valeur de typeNom

        try {
            // Préparer la requête d'insertion
            $sql = "INSERT INTO type_materiel (libelle_materiel) VALUES (:libelle_materiel)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['libelle_materiel' => $typeNom]);

            // Retourner une réponse JSON indiquant le succès
            echo json_encode(['status' => 'success', 'message' => 'Le type de matériel a été ajouté avec succès']);
        } catch (PDOException $e) {
            // Si une erreur survient, retourner une réponse JSON avec l'erreur
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'insertion : ' . $e->getMessage()]);
        }
    } else {
        // Si le champ est vide, retourner une erreur JSON
        echo json_encode(['status' => 'error', 'message' => 'Le nom du type de matériel est requis']);
    }
} else {
    // Si la méthode n'est pas POST, retourner une erreur
    echo json_encode(['status' => 'error', 'message' => 'Méthode de requête non valide']);
}

?>
