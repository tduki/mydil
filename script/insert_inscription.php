<?php
session_start(); // Démarrer la session
include 'db_connexion.php'; 

header('Content-Type: application/json'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $type_user = 1; // Type utilisateur par défaut

    if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Tous les champs sont requis.']);
        exit;
    }

    // Vérifier si l'email existe déjà dans la base de données
    $sqlCheck = "SELECT COUNT(*) FROM identifiants WHERE email = :email";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':email' => $email]);

    if ($stmtCheck->fetchColumn() > 0) {
        echo json_encode(['success' => false, 'message' => "L'adresse email est déjà utilisée."]);
        exit;
    }

    // Hacher le mot de passe
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insérer les données dans la table
    $sql = "INSERT INTO identifiants (nom, prenom, email, mdp, fk_type_user) 
            VALUES (:nom, :prenom, :email, :mdp, :type_user)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':mdp' => $hashedPassword,
            ':type_user' => $type_user
        ]);

        // Récupérer l'ID de l'utilisateur récemment ajouté
        $user_id = $pdo->lastInsertId();

        // Créer la session utilisateur après inscription réussie
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_type'] = $type_user; // Vous pouvez ajuster selon les besoins

        // Réponse de succès
        echo json_encode(['success' => true, 'message' => 'Inscription réussie !']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'inscription : ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Requête non valide.']);
}


?>
