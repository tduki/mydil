<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration Matériel</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<?php include "../script/nav.php"; ?>
<h2 class="text-center mb-4">Configuration Matériel</h2>

<div class="container text-center">
    <div class="mb-4">
        <button class="btn btn-primary" id="showTypeMateriel">Créer/Modifier type de matériel</button>
        <button class="btn btn-secondary" id="showMateriel">Ajouter/Modifier le matériel</button>
    </div>

    <!-- Section Type de Matériel (cachée par défaut) -->
    <div class="mb-4" id="typeMaterielSection" style="display: none;">
        <h3>Type de Matériel</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTypeMaterielModal">Ajouter Type de Matériel</button>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Type Materiel</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="typeMaterielTable">
                <!-- Lignes ajoutées dynamiquement ici -->
            </tbody>
        </table>
    </div>

    <!-- Section Matériel (cachée par défaut) -->
    <div class="mb-4" id="materielSection" style="display: none;">
        <h3>Matériel</h3>
        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addMaterielModal">Ajouter Materiel</button><br><br>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom du matériel</th>
                    <th>Type</th>
                    <th>description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="materielTable">
                <!-- Lignes ajoutées dynamiquement ici -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal pour Ajouter Type de Matériel -->
<div class="modal fade" id="addTypeMaterielModal" tabindex="-1" aria-labelledby="addTypeMaterielModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTypeMaterielModalLabel">Ajouter Type de Matériel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="mb-3">
    <label for="typeNom" class="form-label">Nom du Type</label>
    <input type="text" class="form-control" id="typeNom">
</div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="saveTypeMateriel">Ajouter</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour Modifier Type de Matériel -->
<div class="modal fade" id="editTypeMaterielModal" tabindex="-1" aria-labelledby="editTypeMaterielModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTypeMaterielModalLabel">Modifier Type de Matériel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editTypeId">  <!-- Pour stocker l'ID du type -->
                <div class="mb-3">
                    <label for="editTypeNom" class="form-label">Nom du Type</label>
                    <input type="text" class="form-control" id="editTypeNom">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="updateTypeMateriel">Enregistrer</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal pour Ajouter Matériel -->
<div class="modal fade" id="addMaterielModal" tabindex="-1" aria-labelledby="addMaterielModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMaterielModalLabel">Ajouter Matériel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="materielNom" class="form-label">Nom du Matériel</label>
                    <input type="text" class="form-control" id="materielNom">
                </div>
                <div class="mb-3">
                    <label for="materielType" class="form-label">Type</label>
                    <input type="text" class="form-control" id="materielType">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="saveMateriel">Ajouter</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour Modifier Matériel -->
<div class="modal fade" id="editMaterielModal" tabindex="-1" aria-labelledby="editMaterielModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMaterielModalLabel">Modifier Matériel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editMaterielNom" class="form-label">Nom du Matériel</label>
                    <input type="text" class="form-control" id="editMaterielNom">
                </div>
                <div class="mb-3">
                    <label for="editMaterielType" class="form-label">Type</label>
                    <input type="text" class="form-control" id="editMaterielType">
                </div>
                <div class="mb-3">
                    <label for="editMaterielType" class="form-label">Description</label>
                    <input type="text" class="form-control" id="editMaterielType">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="updateMateriel">Enregistrer</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>


<script>
function chargTypeMateriel() {
    $.ajax({
        url: '../script/get_type_materiel.php',  // Le chemin vers ton script PHP qui récupère les types
        type: 'GET',  // Utilisation de GET pour récupérer les données
        success: function(response) {
            var res = JSON.parse(response);
            if (res.status === 'success') {
                // Vider le tableau avant d'ajouter les nouvelles lignes
                $('#typeMaterielTable').empty();

                // Boucle sur les résultats et ajouter chaque type au tableau
                res.data.forEach(function(type) {
                    $('#typeMaterielTable').append(`
                        <tr>
                            <td>${type.libelle_materiel}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-type-btn" data-id="${type.id}" data-bs-toggle="modal" data-bs-target="#editTypeMaterielModal">Modifier</button>
                            </td>
                        </tr>
                    `);
                });
            } else {
                alert('Erreur : ' + res.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('Erreur AJAX : ', error);
            console.log(xhr.responseText);
        }
    });
}




$(document).ready(function() {
    chargTypeMateriel();   
});

$(document).on('click', '.edit-type-btn', function() {
    var row = $(this).closest('tr');
    var id = $(this).data('id');  // Récupérer l'ID du type
    var nom = row.find('td:nth-child(1)').text();  // Récupérer le nom du type

    // Log des données récupérées
    console.log('ID récupéré :', id);
    console.log('Nom récupéré :', nom);

    // Pré-remplir la modal avec l'ID et le nom actuels
    $('#editTypeId').val(id);  // Stocker l'ID dans un champ caché
    $('#editTypeNom').val(nom);  // Remplir le champ avec le nom actuel

    // Ouvrir la modal
    $('#editTypeMaterielModal').modal('show');
});

$(document).on('click', '#updateTypeMateriel', function() {
    var id = $('#editTypeId').val();  // Récupérer l'ID
    var typeNom = $('#editTypeNom').val().trim();  // Récupérer le nom

    console.log('ID envoyé :', id);  // Vérifier que l'ID est récupéré
    console.log('Nom envoyé :', typeNom);  // Vérifier que le nom est récupéré

    if (typeNom && id) {
        $.ajax({
            url: '../script/update_type_materiel.php',  // Ton script PHP de mise à jour
            type: 'POST',
            data: {
                id: id,  // Envoi de l'ID
                typeNom: typeNom  // Envoi du nouveau nom
            },
            success: function(response) {
                console.log('Réponse du serveur:', response);  // Log pour voir la réponse du serveur
                try {
                    var res = JSON.parse(response);  // Parse la réponse en JSON
                    if (res.status === 'success') {
                        alert('Le type de matériel a été mis à jour avec succès.');
                        $('#editTypeMaterielModal').modal('hide');
                        chargTypeMateriel();  // Recharger la liste pour voir les changements
                    } else {
                        alert('Erreur de mise à jour : ' + res.message);
                    }
                } catch (e) {
                    console.log('Erreur de parsing JSON:', e);
                    console.log('Réponse brute:', response);  // Si la réponse n'est pas en JSON, log la réponse brute
                }
            },
            error: function(xhr, status, error) {
                console.log('Erreur AJAX :', error);  // Log pour détecter les erreurs AJAX
                console.log(xhr.responseText);  // Log de la réponse en cas d'erreur
            }
        });
    } else {
        alert('Veuillez remplir tous les champs.');
    }
});


$('#updateTypeMateriel').click(function() {
    console.log('Bouton Enregistrer cliqué');  // Vérifie si ce log s'affiche
    var id = $('#editTypeId').val();
    var typeNom = $('#editTypeNom').val().trim();

    if (typeNom && id) {
        console.log('ID :', id);  // Vérifie l'ID
        console.log('Type Nom :', typeNom);  // Vérifie le type de matériel
    } else {
        console.log('Données manquantes');  // Vérifie si les champs sont remplis
    }
});



$('#saveTypeMateriel').click(function() {
    var typeNom = $('#typeNom').val().trim();  // Utilise trim() pour éliminer les espaces
    
    console.log('Valeur récupérée :', typeNom);  // Vérification dans la console

    if (typeNom) {
        // Si le champ typeNom n'est pas vide, on continue avec l'envoi AJAX
        var formData = new FormData();
        formData.append('typeNom', typeNom);

        $.ajax({
            url: '../script/insert_type_materiel.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    alert(res.message);

                    // Ajouter au tableau et réinitialiser le champ
                    $('#addTypeMaterielModal').modal('hide');
                    $('#typeNom').val('');
                    $('#typeMaterielTable').append(`
                        <tr>
                            <td>${typeNom}</td>
                            <td><button class="btn btn-warning btn-sm edit-type-btn">Modifier</button></td>
                        </tr>
                    `);
                } else {
                    alert(res.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('Erreur AJAX : ', error);
                console.log(xhr.responseText);
            }
        });
    } else {
        // Si le champ typeNom est vide, on affiche un message d'alerte
        alert('Veuillez entrer un nom pour le type de matériel.');
    }
});


    // Gestion de l'affichage des sections
    $('#showTypeMateriel').click(function() {
        $('#typeMaterielSection').show();
        $('#materielSection').hide();
    });

    $('#showMateriel').click(function() {
        $('#materielSection').show();
        $('#typeMaterielSection').hide();
    });

    // Ajouter un type de matériel depuis la modal
    $('#saveTypeMateriel').click(function() {
        var nom = $('#typeNom').val();
        if(nom) {
            $('#typeMaterielTable').append(`
                <tr>
                    <td>${nom}</td>
                    <td><button class="btn btn-warning btn-sm edit-type-btn" data-bs-toggle="modal" data-bs-target="#editTypeMaterielModal">Modifier</button></td>
                </tr>
            `);
            $('#addTypeMaterielModal').modal('hide');
            $('#typeNom').val('');
        }
    });

    // Ajouter un matériel depuis la modal
    $('#saveMateriel').click(function() {
        var nom = $('#materielNom').val();
        var type = $('#materielType').val();
        if(nom && type) {
            $('#materielTable').append(`
                <tr>
                    <td>${nom}</td>
                    <td>${type}</td>
                    <td><button class="btn btn-warning btn-sm edit-materiel-btn" data-bs-toggle="modal" data-bs-target="#editMaterielModal">Modifier</button></td>
                </tr>
            `);
            $('#addMaterielModal').modal('hide');
            $('#materielNom').val('');
            $('#materielType').val('');
        }
    });

    // Fonction pour le bouton modifier (type de matériel)
    $(document).on('click', '.edit-type-btn', function() {
        var row = $(this).closest('tr');
        var nom = row.find('td:nth-child(1)').text();
        $('#editTypeNom').val(nom);
        // Enregistrer les modifications
        $('#updateTypeMateriel').off().click(function() {
            row.find('td:nth-child(1)').text($('#editTypeNom').val());
            $('#editTypeMaterielModal').modal('hide');
        });
    });

    // Fonction pour le bouton modifier (matériel)
    $(document).on('click', '.edit-materiel-btn', function() {
        var row = $(this).closest('tr');
        var nom = row.find('td:nth-child(1)').text();
        var type = row.find('td:nth-child(2)').text();
        $('#editMaterielNom').val(nom);
        $('#editMaterielType').val(type);
        // Enregistrer les modifications
        $('#updateMateriel').off().click(function() {
            row.find('td:nth-child(1)').text($('#editMaterielNom').val());
            row.find('td:nth-child(2)').text($('#editMaterielType').val());
            $('#editMaterielModal').modal('hide');
        });
    });

   
</script>

</body>
</html>
