<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiels</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <style>
        /* Code couleur pour le statut du matériel */
        .status-disponible {
            background-color: #28a745;
            color: white;
        }
        .status-maintenance {
            background-color: #ffc107;
            color: black;
        }
        .status-hors-service {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

<?php include "../script/nav.php"; ?>

<div class="container mt-4">
    <h2 class="text-center">Liste des Matériels</h2>
    <table class="table table-bordered" id="materielTable">
        <thead>
            <tr>
                <th>Nom du matériel</th>
                <th>Status</th>
                <th>État</th>
                <th>Type de Matériel</th>
                <th>Date début réservation</th>
                <th>Date fin réservation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Lignes du tableau ajoutées dynamiquement ici via Ajax -->
        </tbody>
    </table>
</div>

<!-- Modal pour Modifier le status du Matériel -->
<div class="modal fade" id="editStatusMaterielModal" tabindex="-1" aria-labelledby="editStatusMaterielModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStatusMaterielModalLabel">Modifier le status du matériel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="materielId"> <!-- Champ caché pour stocker l'ID du matériel -->
                <div class="mb-3">
                    <label for="statusMateriel" class="form-label">Status</label>
                    <select class="form-control" id="statusMateriel">
                        <option value="Disponible">Disponible</option>
                        <option value="En maintenance">En maintenance</option>
                        <option value="Hors service">Hors service</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="saveStatusMateriel">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Charger les matériels avec leurs réservations
    function loadMateriels() {
        $.ajax({
            url: '../script/get_materiels_reservation.php',
            type: 'GET',
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    $('#materielTable tbody').empty();  // Vider le tableau avant de l'ajouter
                    res.data.forEach(function(materiel) {
                        $('#materielTable tbody').append(`
                            <tr>
                                <td>${materiel.nom_materiel}</td>
                                <td>${materiel.status}</td>
                                <td>${materiel.etat}</td>
                                <td>${materiel.libelle_materiel}</td>
                                <td>${materiel.date_debut ? materiel.date_debut : 'Non réservé'}</td>
                                <td>${materiel.date_fin ? materiel.date_fin : 'Non réservé'}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit-status-btn" data-id="${materiel.id}" data-status="${materiel.status}">Modifier Status</button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    alert('Erreur lors du chargement des matériels : ' + res.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erreur AJAX :', error);
                console.error('Réponse du serveur :', xhr.responseText);
            }
        });
    }

    $(document).ready(function() {
        // Charger les matériels au chargement de la page
        loadMateriels();

        // Ouvrir la modal pour modifier le status du matériel
        $(document).on('click', '.edit-status-btn', function() {
            var id = $(this).data('id');
            var status = $(this).data('status');
            $('#materielId').val(id);
            $('#statusMateriel').val(status);
            $('#editStatusMaterielModal').modal('show');
        });

        // Sauvegarder le status du matériel
        $('#saveStatusMateriel').click(function() {
            var id = $('#materielId').val();
            var status = $('#statusMateriel').val();
            $.ajax({
                url: '../script/update_status_materiel.php',
                type: 'POST',
                data: { id: id, status: status },
                success: function(response) {
                    var res = (typeof response === "string") ? JSON.parse(response) : response;  
                    if (res.status === 'success') {
                        alert(res.message);
                        $('#editStatusMaterielModal').modal('hide');
                        loadMateriels();  // Recharger la liste après la mise à jour
                    } else {
                        alert('Erreur : ' + res.message);
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
