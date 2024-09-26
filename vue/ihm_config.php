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
                    <th>Description</th>
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
            <h5 class="modal-title" id="editStatusMaterielModalLabel">Modifier le nom du matériel  <span id="nomMateriel"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editTypeId"> <!-- Pour stocker l'ID du type -->
                <div class="mb-3">
                    <label for="editTypeNom" class="form-label">Nom du Type</label>
                    <input type="text" class="form-control" id="editTypeNom">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateTypeMateriel">Enregistrer</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
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
                    <label for="materielType" class="form-label">Type de Matériel</label>
                    <!-- Liste déroulante dynamique pour les types de matériel -->
                    <select class="form-control" id="materielType">
                        <option value="">Sélectionnez un type</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="materielDesc" class="form-label">Description</label>
                    <textarea class="form-control" id="materielDesc"></textarea>
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
                    <select class="form-control" id="editMaterielType">
                        <option value="">Sélectionnez un type</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="editMaterielDesc" class="form-label">Description</label>
                    <textarea class="form-control" id="editMaterielDesc"></textarea>
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
            url: '../script/get_type_materiel.php',  
            type: 'GET',
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    $('#typeMaterielTable').empty();
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

    function chargMateriel() {
        $.ajax({
            url: '../script/get_materiel.php',
            type: 'GET',
            success: function(response) {
                var res = (typeof response === "object") ? response : JSON.parse(response);
                if (res.status === 'success') {
                    $('#materielTable').empty();
                    res.data.forEach(function(materiel) {
                        $('#materielTable').append(`
                            <tr>
                                <td>${materiel.nom_materiel}</td>
                                <td>${materiel.libelle_materiel}</td>
                                <td>${materiel.description}</td>
                                <td><button class="btn btn-warning btn-sm edit-materiel-btn" data-id="${materiel.id}">Modifier</button></td>
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

    function chargTypeMaterielOptions(callback) {
    $.ajax({
        url: '../script/get_type_materiel.php',   // Script PHP qui récupère les types de matériel
        type: 'GET',
        success: function(response) {
            var res = (typeof response === "object") ? response : JSON.parse(response);
            if (res.status === 'success') {
                // Vider les listes déroulantes avant de les remplir
                $('#materielType').empty();  // Liste déroulante pour l'ajout de matériel
                $('#editMaterielType').empty();  // Liste déroulante pour la modification de matériel
                
                // Option par défaut
                $('#materielType').append('<option value="">Sélectionnez un type</option>');
                $('#editMaterielType').append('<option value="">Sélectionnez un type</option>');
                
                // Remplir les deux listes déroulantes avec les types de matériel
                res.data.forEach(function(type) {
                    $('#materielType').append(`
                        <option value="${type.id}">${type.libelle_materiel}</option>
                    `);
                    $('#editMaterielType').append(`
                        <option value="${type.id}">${type.libelle_materiel}</option>
                    `);
                });
                
                if (typeof callback === 'function') {
                    callback();  // Appeler le callback après avoir chargé les options
                }
            } else {
                alert('Erreur : ' + res.message);
            }
        },
        error: function(xhr, status, error) {
            console.log('Erreur AJAX :', error);
        }
    });
}



    $('#addMaterielModal').on('show.bs.modal', function() {
        chargTypeMaterielOptions();
    });

    $(document).ready(function() {
        chargTypeMateriel();  
        chargTypeMaterielOptions(); 
        chargMateriel();
    });

    $(document).on('click', '.edit-type-btn', function() {
    var row = $(this).closest('tr');
    var id = $(this).data('id');
    var nom = row.find('td:nth-child(1)').text();
    
    // Mettre à jour le champ caché avec l'ID du type de matériel
    $('#editTypeId').val(id);
    
    // Afficher le nom du type de matériel dans le champ et dans le titre de la modale
    $('#editTypeNom').val(nom);
    $('#editTypeMaterielModalLabel').text('Modifier Type de Matériel : ' + nom);
    
    // Ouvrir la modale
    $('#editTypeMaterielModal').modal('show');
});


    $('#updateTypeMateriel').click(function() {
        var id = $('#editTypeId').val();
        var typeNom = $('#editTypeNom').val().trim();

        if (typeNom && id) {
            $.ajax({
                url: '../script/update_type_materiel.php',
                type: 'POST',
                data: {
                    id: id,
                    typeNom: typeNom
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        alert('Le type de matériel a été mis à jour.');
                        $('#editTypeMaterielModal').modal('hide');
                        chargTypeMateriel();
                    } else {
                        alert('Erreur de mise à jour : ' + res.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Erreur AJAX :', error);
                }
            });
        } else {
            alert('Veuillez remplir tous les champs.');
        }
    });

    $('#saveTypeMateriel').click(function() {
        var typeNom = $('#typeNom').val().trim();

        if (typeNom) {
            $.ajax({
                url: '../script/insert_type_materiel.php',
                type: 'POST',
                data: {
                    typeNom: typeNom
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        alert(res.message);
                        $('#addTypeMaterielModal').modal('hide');
                        $('#typeNom').val('');
                        chargTypeMateriel();
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
            alert('Veuillez entrer un nom pour le type de matériel.');
        }
    });

    $('#saveMateriel').click(function() {
        var nom = $('#materielNom').val();
        var type = $('#materielType').val();
        var desc = $('#materielDesc').val();

        if (nom && type && desc) {
            $.ajax({
                url: '../script/insert_materiel.php',
                type: 'POST',
                data: {
                    nom: nom,
                    type: type,
                    description: desc
                },
                success: function(response) {
                    var res = (typeof response === "string") ? JSON.parse(response) : response;  
                    if (res.status === 'success') {
                        alert(res.message);
                        $('#addMaterielModal').modal('hide');
                        $('#materielNom').val('');
                        $('#materielType').val('');
                        $('#materielDesc').val('');
                        chargMateriel();
                    } else {
                        alert(res.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erreur AJAX :', error);
                    console.error('Réponse du serveur :', xhr.responseText);
                }
            });
        } else {
            alert('Veuillez remplir tous les champs.');
        }
    });

// Fonction appelée lorsque l'on clique sur le bouton "Modifier" pour un matériel
$(document).on('click', '.edit-materiel-btn', function() {
    var row = $(this).closest('tr');
    var id = $(this).data('id');  // Récupérer l'ID du matériel
    var nom = row.find('td:nth-child(1)').text();  // Récupérer le nom du matériel
    var type = row.find('td:nth-child(2)').text();  // Récupérer le type (libellé) du matériel
    var desc = row.find('td:nth-child(3)').text();  // Récupérer la description du matériel

    // Affichage des valeurs actuelles dans la modal
    $('#editMaterielNom').val(nom);
    $('#editMaterielDesc').val(desc);

    // Charger les types de matériel dans le dropdown avec le type actuellement sélectionné
    chargTypeMaterielOptions(function() {
        // Il faut sélectionner l'option correspondant au type actuel du matériel
        $('#editMaterielType option').each(function() {
            if ($(this).text() === type) {
                $(this).prop('selected', true);
            }
        });
    });

    // Stocker l'ID du matériel dans le bouton de sauvegarde
    $('#updateMateriel').data('id', id);

    // Ouvrir la modal
    $('#editMaterielModal').modal('show');
});


$('#updateMateriel').click(function() {
    var id = $(this).data('id');
    var newNom = $('#editMaterielNom').val().trim();
    var newType = $('#editMaterielType').val().trim();
    var newDesc = $('#editMaterielDesc').val().trim();

    if (newNom && newType && id) {
        $.ajax({
            url: '../script/update_materiel.php',
            type: 'POST',
            data: {
                id: id,
                nom: newNom,
                type: newType,
                description: newDesc
            },
            success: function(response) {
                console.log("Réponse brute du serveur :", response);
                
                // Vérifie si la réponse est déjà un objet, sinon, parse en JSON
                var res = (typeof response === "object") ? response : JSON.parse(response);

                if (res.status === 'success') {
                    alert('Matériel mis à jour.');
                    $('#editMaterielModal').modal('hide');
                    chargMateriel();
                } else {
                    alert('Erreur de mise à jour : ' + res.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('Erreur AJAX :', error);
                console.log('Réponse du serveur :', xhr.responseText);
            }
        });
    } else {
        alert('Veuillez remplir tous les champs.');
    }
});


    $('#showTypeMateriel').click(function() {
        $('#typeMaterielSection').show();
        $('#materielSection').hide();
    });

    $('#showMateriel').click(function() {
        $('#materielSection').show();
        $('#typeMaterielSection').hide();
    });
</script>
</body>
</html>
