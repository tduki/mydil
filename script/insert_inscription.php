<?php
// Inclure la connexion à la base de données
include 'db_connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $type_user = 1; // "1" user par défaut

    // Hacher le mot de passe avec bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Préparer la requête SQL pour insérer les données dans la table 'identifiants'
    $sql = "INSERT INTO identifiants (nom, prenom, email, mdp, fk_type_user) 
            VALUES (?, ?, ?, ?, ?)";

    // Utilisation de MySQLi pour préparer et exécuter la requête
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssssi", $nom, $prenom, $email, $hashedPassword, $type_user);
        
        if ($stmt->execute()) {
            echo "Inscription réussie !";
        } else {
            // Gestion des erreurs
            if ($mysqli->errno == 1062) {  // Code erreur pour doublon (email déjà existant)
                echo "L'adresse email est déjà utilisée.";
            } else {
                echo "Erreur : " . $mysqli->error;
            }
        }
        
        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête : " . $mysqli->error;
    }
}
?>
