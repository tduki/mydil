<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gestion des Comptes</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php include "../script/nav.php"; ?>

<div class="container mt-4">
    <h2 class="text-center">Gestion des Comptes Utilisateurs</h2>

    <!-- Tableau des utilisateurs -->
    <div id="userSection">
        <table class="table table-bordered mt-4" id="userTable">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Groupe</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Les lignes seront ajoutées dynamiquement ici via Ajax -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal pour Modifier le groupe de l'utilisateur -->
<div class="modal fade" id="editUserGroupModal" tabindex="-1" aria-labelledby="editUserGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserGroupModalLabel">Modifier le Groupe d'Utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="userId"> <!-- Champ caché pour stocker l'ID de l'utilisateur -->
                <div class="mb-3">
                    <label for="userGroup" class="form-label">Groupe</label>
                    <select class="form-control" id="userGroup">
                        <option value="1">User</option>
                        <option value="2">Responsable</option>
                        <option value="3">Admin</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveUserGroup">Enregistrer</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>

<script>
// Charger la liste des utilisateurs
function loadUsers() {
    $.ajax({
        url: '../script/get_users.php',  // URL pour récupérer la liste des utilisateurs
        type: 'GET',
        success: function(response) {
            var res = (typeof response === "object") ? response : JSON.parse(response);
            $('#userTable tbody').empty();  // Vider le tableau avant de le remplir

            if (res.status === 'success' && res.data.length > 0) {
                // Ajouter les utilisateurs au tableau
                res.data.forEach(function(user) {
                    $('#userTable tbody').append(`
                        <tr>
                            <td>${user.nom}</td>
                            <td>${user.prenom}</td>
                            <td>${user.email}</td>
                            <td>${user.groupe}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-group-btn" data-id="${user.id}" data-group="${user.groupe}">Modifier</button>
                            </td>
                        </tr>
                    `);
                });
            } else {
                // Si aucun utilisateur trouvé, afficher un message
                $('#userTable tbody').append(`
                    <tr>
                        <td colspan="5" class="text-center">Aucun utilisateur trouvé.</td>
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
    // Charger la liste des utilisateurs au chargement de la page
    loadUsers();

    // Ouvrir la modal pour modifier le groupe d'utilisateur
    $(document).on('click', '.edit-group-btn', function() {
        var id = $(this).data('id');
        var group = $(this).data('group');

        $('#userId').val(id);  // Stocker l'ID de l'utilisateur dans la modal
        $('#userGroup').val(group);  // Pré-sélectionner le groupe dans la liste déroulante
        $('#editUserGroupModal').modal('show');
    });

    // Sauvegarder les modifications du groupe
    $('#saveUserGroup').click(function() {
        var id = $('#userId').val();
        var group = $('#userGroup').val();

        $.ajax({
            url: '../script/update_user_group.php',
            type: 'POST',
            data: { id: id, group: group },
            success: function(response) {
                var res = (typeof response === "string") ? JSON.parse(response) : response;
                if (res.status === 'success') {
                    alert(res.message);
                    $('#editUserGroupModal').modal('hide');
                    loadUsers();  // Recharger la liste des utilisateurs après la mise à jour
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
