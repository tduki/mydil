<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<?php include "../script/nav.php"; ?>

<div class="container mt-4">
    <h2 class="text-center">Mes Réservations</h2>

    <!-- Tableau des réservations de l'utilisateur -->
    <div id="reservationSection">
        <table class="table table-bordered mt-4" id="reservationTable">
            <thead>
                <tr>
                    <th>Nom du matériel</th>
                    <th>Type de Matériel</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Raison</th>
                </tr>
            </thead>
            <tbody>
                <!-- Les lignes seront ajoutées dynamiquement ici via Ajax -->
            </tbody>
        </table>
    </div>
</div>

<script>
// Charger les réservations de l'utilisateur
function loadUserReservations() {
    $.ajax({
        url: '../script/get_user_reservations.php',  // URL pour récupérer les réservations de l'utilisateur
        type: 'GET',
        success: function(response) {
            var res = (typeof response === "object") ? response : JSON.parse(response); 
            $('#reservationTable tbody').empty();  // Vider le tableau avant de le remplir

            if (res.status === 'success' && res.data.length > 0) {
                // Ajouter les réservations au tableau
                res.data.forEach(function(reservation) {
                    $('#reservationTable tbody').append(`
                        <tr>
                            <td>${reservation.nom_materiel}</td>
                            <td>${reservation.type_materiel}</td>
                            <td>${reservation.date_debut}</td>
                            <td>${reservation.date_fin}</td>
                            <td>${reservation.raison}</td>
                        </tr>
                    `);
                });
            } else {
                // Si aucune réservation, afficher un message
                $('#reservationTable tbody').append(`
                    <tr>
                        <td colspan="5" class="text-center">Aucune réservation trouvée.</td>
                    </tr>
                `);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erreur AJAX :', error);
            console.error('Réponse du serveur :', xhr.responseText);
        }
    });
}

$(document).ready(function() {
    // Charger les réservations de l'utilisateur au chargement de la page
    loadUserReservations();
});
</script>

</body>
</html>
