<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
                        <h2 class="text-center mb-4">Connexion</h2>

                        <!-- Div pour afficher les messages d'erreur ou de succès -->
                        <div id="message" class="alert d-none" role="alert"></div>

                        <form id="connexionForm" method="POST">
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

                            <!-- Bouton Connexion -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                            </div>

                            <!-- Lien vers inscription -->
                            <div class="text-center mt-3">
                                Vous n'avez pas de compte ? <a href="ihm_inscription.php">S'inscrire</a>
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
$(document).ready(function() {
    $('#connexionForm').on('submit', function(event) {
        event.preventDefault(); // Empêche le rechargement de la page

        // Envoi des données via AJAX
        $.post('../script/get_connexion.php', {
            email: $('#email').val(),
            password: $('#password').val()
        }, function(response) {
            // Afficher le message
            console.log("Réponse brute : ", response);  // Vérifier la réponse JSON brute
            const messageDiv = $('#message');
            messageDiv.removeClass('d-none alert-danger alert-success');

            if (response.success) {
                messageDiv.addClass('alert-success').text(response.message);
                // Redirection après connexion réussie
                setTimeout(function() {
                    window.location.href = 'ihm_reservation.php';
                }, 1000);
            } else {
                messageDiv.addClass('alert-danger').text(response.message);
            }
        }, 'json').fail(function(jqXHR, textStatus, errorThrown) {
            // Gérer les erreurs AJAX
            console.log("Erreur AJAX: ", textStatus, errorThrown);  // Log pour déboguer les erreurs AJAX
            $('#message').removeClass('d-none').addClass('alert-danger').text('Une erreur est survenue lors de la connexion.');
        });
    });
});

</script>

</body>
</html>
