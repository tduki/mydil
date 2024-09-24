<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "../script/nav.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="text-center mb-4">Inscription</h2>

                    <!-- Div pour afficher les messages d'erreur ou de succès -->
                    <div id="message" class="alert d-none" role="alert"></div>

                    <form id="inscriptionForm" method="POST">
                        <!-- Nom -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez votre nom" required>
                        </div>

                        <!-- Prénom -->
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrez votre prénom" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre adresse email" required>
                        </div>

                        <!-- Mot de passe -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required>
                        </div>

                        <!-- Bouton S'inscrire -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
                        </div>

                        <!-- Lien vers connexion -->
                        <div class="text-center mt-3">
                            Vous avez déjà un compte ? <a href="ihm_connexion.php">Connexion</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lien vers les scripts JavaScript de Bootstrap et jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
<script>
// AJAX pour envoyer le formulaire
$(document).ready(function() {
    $('#inscriptionForm').on('submit', function(event) {
        event.preventDefault(); // Empêche le rechargement de la page

        // Récupérer les données du formulaire
        var formData = {
            nom: $('#nom').val(),
            prenom: $('#prenom').val(),
            email: $('#email').val(),
            password: $('#password').val()
        };

        // Envoi des données via AJAX
        $.ajax({
            url: '../script/insert_inscription.php', 
            type: 'POST',
            data: formData,
            dataType: 'json', 
            success: function(response) {
                if (response.success) {
                    // Si l'inscription est réussie
                    $('#message').removeClass('d-none alert-danger').addClass('alert-success').text(response.message);
                    // Rediriger vers la page d'accueil ou tableau de bord
                    setTimeout(function() {
                        window.location.href = "ihm_reservation.php";  
                    }, 500); 
                } else {
                    // Si une erreur survient
                    $('#message').removeClass('d-none alert-success').addClass('alert-danger').text(response.message);
                }
            },
            error: function(xhr, status, error) {
                // En cas d'erreur de requête
                $('#message').removeClass('d-none alert-success').addClass('alert-danger').text("Erreur : " + xhr.responseText);
            }
        });
    });
});
</script>

</script>
</body>
</html>
