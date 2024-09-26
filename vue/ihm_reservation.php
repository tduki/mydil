<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<?php include "../script/nav.php"; ?>

<div class="container mt-4">
    <h2 class="text-center">Réserver un Matériel</h2>

    <!-- Liste déroulante pour sélectionner le type de matériel -->
    <div class="mb-3 text-center">
        <label for="typeMateriel" class="form-label">Sélectionner un type de matériel :</label>
        <select id="typeMateriel" class="form-select" style="width: 50%; margin: 0 auto;">
            <option value="">Choisir un type de matériel</option>
            <!-- Les options seront ajoutées dynamiquement ici -->
        </select>
    </div>

    <!-- Tableau des matériels disponibles, caché par défaut -->
    <div id="materielSection" style="display: none;">
        <table class="table table-bordered mt-4" id="materielTable">
            <thead>
                <tr>
                    <th>Nom du matériel</th>
                    <th>Status</th>
                    <th>État</th>
                    <th>Type de Matériel</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Les lignes seront ajoutées dynamiquement ici -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal pour Réserver un Matériel -->
<div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalLabel">Réserver le matériel : <span id="materielNom"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="materielId"> <!-- Champ caché pour stocker l'ID du matériel -->
                <div class="mb-3">
                    <label for="dateDebut" class="form-label">Date de début</label>
                    <input type="date" class="form-control" id="dateDebut">
                </div>
                <div class="mb-3">
                    <label for="dateFin" class="form-label">Date de fin</label>
                    <input type="date" class="form-control" id="dateFin">
                </div>
                <div class="mb-3">
                    <label for="raisonReservation" class="form-label">Raison</label>
                    <textarea class="form-control" id="raisonReservation" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveReservation">Valider</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Charger les types de matériel pour la liste déroulante
    function loadTypesMateriel() {
        $.ajax({
            url: '../script/get_type_materiel.php',  // URL pour récupérer les types de matériel
            type: 'GET',
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    $('#typeMateriel').empty();  // Vider la liste déroulante avant de la remplir
                    $('#typeMateriel').append('<option value="">Choisir un type de matériel</option>');  // Option par défaut
                    res.data.forEach(function(type) {
                        $('#typeMateriel').append(`
                            <option value="${type.id}">${type.libelle_materiel}</option>
                        `);
                    });
                } else {
                    alert('Erreur : ' + res.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('Erreur AJAX :', error);
                console.log(xhr.responseText);
            }
        });
    }

    // Charger les matériels disponibles en fonction du type sélectionné
 function loadMaterielsDisponibles(typeId = '') {
    $.ajax({
        url: '../script/get_materiels_disponibles.php',  // URL pour récupérer les matériels disponibles
        type: 'GET',
        data: { typeId: typeId },  // Envoyer l'ID du type de matériel si un type est sélectionné
        success: function(response) {
            var res = JSON.parse(response);
            $('#materielTable tbody').empty();  // Vider le tableau avant de le remplir

            if (res.status === 'success' && res.data.length > 0) {
                // Ajouter les matériels au tableau
                res.data.forEach(function(materiel) {
                    $('#materielTable tbody').append(`
                        <tr>
                            <td>${materiel.nom_materiel}</td>
                            <td>${materiel.status}</td>
                            <td>${materiel.etat}</td>
                            <td>${materiel.libelle_materiel}</td>
                            <td>${materiel.description}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-id="${materiel.id}">Réserver</button>
                            </td>
                        </tr>
                    `);
                });
            } else {
                // Si aucun matériel disponible, afficher un message dans le tableau
                $('#materielTable tbody').append(`
                    <tr>
                        <td colspan="6" class="text-center">Aucun matériel trouvé disponibles.</td>
                    </tr>
                `);
            }
        },
        error: function(xhr, status, error) {
            console.log('Erreur AJAX :', error);
            console.log(xhr.responseText);
        }
    });
 }

    $(document).ready(function() {
    // Charger les types de matériel au chargement de la page
    loadTypesMateriel();

    // Recharger les matériels disponibles lors du changement de type
    $('#typeMateriel').change(function() {
        var selectedType = $(this).val();

        // Si un type est sélectionné, afficher le tableau
        if (selectedType) {
            $('#materielSection').show();  // Afficher le tableau
            loadMaterielsDisponibles(selectedType);  // Charger les matériels en fonction du type sélectionné
        } else {
            $('#materielSection').hide();  // Masquer le tableau si aucun type n'est sélectionné
        }
    });

    // Ouvrir la modal pour réserver un matériel
    $(document).on('click', '.btn-primary', function() {
        var id = $(this).data('id');
        var nomMateriel = $(this).closest('tr').find('td:first').text();
        $('#materielId').val(id);  // Stocker l'ID du matériel
        $('#materielNom').text(nomMateriel);  // Afficher le nom du matériel dans la modal
        $('#reservationModal').modal('show');
    });

    // Sauvegarder la réservation
    $('#saveReservation').click(function() {
    var idMateriel = $('#materielId').val();
    var dateDebut = $('#dateDebut').val();
    var dateFin = $('#dateFin').val();
    var raison = $('#raisonReservation').val();

    $.ajax({
        url: '../script/reservation_materiel.php',
        type: 'POST',
        data: {
            id_materiel: idMateriel,
            date_debut: dateDebut,
            date_fin: dateFin,
            raison: raison
        },
        success: function(response) {
            try {
                var res = (typeof response === "string") ? JSON.parse(response) : response;  
                if (res.status === 'success') {
                    alert(res.message);
                    $('#reservationModal').modal('hide');
                    loadMaterielsDisponibles($('#typeMateriel').val()); 
                } else {
                    alert('Erreur : ' + res.message);
                }
            } catch (e) {
                console.error('Erreur lors du parsing JSON :', e);
                console.error('Réponse brute du serveur :', response);
                alert('Une erreur est survenue lors du traitement de la réservation.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Erreur AJAX :', error);
            console.error('Réponse du serveur :', xhr.responseText);
        }
    });
});

});
</script>

</body>
</html>
