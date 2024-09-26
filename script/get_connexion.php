<?php

session_start();

include 'db_connexion.php';

// demarrer le tampon de sortie pour capturer tout texte parasite
ob_start();
// renvoie un format json pour la page
header('Content-Type: application/json'); 

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // verification des champs
        if (empty($email) || empty($password)) {
            // Nettoyer le tampon de sortie et envoyer une réponse JSON
            ob_clean();  // Nettoie tout texte parasite
            echo json_encode(['success' => false, 'message' => 'Tous les champs sont requis.']);
            exit;
        }

        // verifier si l'utilisateur existe dans la base de données
        $sql = "SELECT * FROM identifiants WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mdp'])) {
            // Créer une session pour l'utilisateur
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_nom'] = $user['nom'];
            $_SESSION['user_type'] = $user['fk_type_user'];

            // Nettoyer le tampon de sortie et envoyer une réponse JSON
            ob_clean();
            echo json_encode(['success' => true, 'message' => 'Connexion réussie']);
        } else {
            // Nettoyer le tampon de sortie et envoyer une réponse JSON
            ob_clean();
            echo json_encode(['success' => false, 'message' => 'Email ou mot de passe incorrect.']);
        }
    }
} catch (Exception $e) {
    // Nettoyer le tampon de sortie avant d'envoyer la réponse
    ob_clean();
    
    // Envoi d'une réponse JSON en cas d'erreur serveur
    echo json_encode(['success' => false, 'message' => 'Une erreur est survenue : ' . $e->getMessage()]);
}

// Fermer le tampon de sortie
ob_end_flush();
exit;

?>