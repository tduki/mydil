<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Historique Appareil</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</head>
<body>

<?php include "../script/nav.php"; ?>

<div class="container mt-4">
    <h2 class="text-center">Historique des Réservations d'un Appareil</h2>

    <!-- Liste déroulante pour sélectionner le type de matériel -->
    <div class="mb-3 text-center">
        <label for="typeMateriel" class="form-label">Sélectionner un type d'appareil :</label>
        <select id="typeMateriel" class="form-select" style="width: 50%; margin: 0 auto;">
            <option value="">Choisir un type d'appareil</option>
            <!-- Les options seront ajoutées dynamiquement ici -->
        </select>
    </div>

    <!-- Liste déroulante pour sélectionner l'appareil -->
    <div class="mb-3 text-center">
        <label for="materiel" class="form-label">Sélectionner un appareil :</label>
        <select id="materiel" class="form-select" style="width: 50%; margin: 0 auto;">
            <option value="">Choisir un appareil</option>
            <!-- Les options seront ajoutées dynamiquement ici -->
        </select>
    </div>

    <!-- Sélection des dates -->
    <div class="text-center">
        <label for="dateDebut" class="form-label">Date de début :</label>
        <input type="date" id="dateDebut" class="form-control" style="width: 50%; margin: 0 auto;">

        <label for="dateFin" class="form-label mt-2">Date de fin :</label>
        <input type="date" id="dateFin" class="form-control" style="width: 50%; margin: 0 auto;">
    </div>

    <!-- Bouton pour télécharger le PDF -->
    <div class="text-center mt-4">
        <button class="btn btn-primary" id="downloadPDF">Télécharger PDF</button>
    </div>
</div>

<script>
    // Charger les types de matériel pour la liste déroulante
    function loadTypesMateriel() {
        $.ajax({
            url: '../script/get_type_materiel.php',  // URL pour récupérer les types de matériel
            type: 'GET',
            success: function(response) {
                var res = (typeof response === "string") ? JSON.parse(response) : response;  
                if (res.status === 'success') {
                    $('#typeMateriel').empty();  // Vider la liste déroulante avant de la remplir
                    $('#typeMateriel').append('<option value="">Choisir un type d\'appareil</option>');  // Option par défaut
                    res.data.forEach(function(type) {
                        $('#typeMateriel').append(`<option value="${type.id}">${type.libelle_materiel}</option>`);
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

    // Charger les matériels en fonction du type sélectionné
    function loadMateriels(typeId) {
    $.ajax({
        url: '../script/get_materiel_filter.php',  
        type: 'GET',
        data: { typeId: typeId },
        success: function(response) {
    console.log("Réponse reçue du serveur :", response);  // Ajouter cette ligne pour afficher la réponse du serveur
    var res = (typeof response === "string") ? JSON.parse(response) : response;
    $('#materiel').empty();  // Vider la liste déroulante avant de la remplir
    if (res.status === 'success') {
        $('#materiel').append('<option value="">Choisir un appareil</option>');
        res.data.forEach(function(materiel) {
            $('#materiel').append(`<option value="${materiel.id}">${materiel.nom_materiel}</option>`);
        });
    } else {
        alert('Erreur : ' + res.message);
        console.log('Réponse reçue avec erreur:', response);
    }

},

        error: function(xhr, status, error) {
            console.log('Erreur AJAX :', error);
            console.log('Réponse du serveur :', xhr.responseText);
        }
    });
}


    $(document).ready(function() {
        loadTypesMateriel();

        $('#typeMateriel').change(function() {
    var selectedType = $(this).val();
    console.log("Type de matériel sélectionné:", selectedType);  // Vérification du type sélectionné
    if (selectedType) {
        loadMateriels(selectedType);
    } else {
        $('#materiel').empty();
        $('#materiel').append('<option value="">Choisir un appareil</option>');
    }
});


        // Télécharger le PDF avec l'historique
        $('#downloadPDF').click(function() {
            var materielId = $('#materiel').val();
            var dateDebut = $('#dateDebut').val();
            var dateFin = $('#dateFin').val();

            if (!materielId || !dateDebut || !dateFin) {
                alert('Veuillez sélectionner toutes les informations nécessaires.');
                return;
            }

            window.location.href = `../script/generer_pdf.php?materiel_id=${materielId}&date_debut=${dateDebut}&date_fin=${dateFin}`;
        });
    });
</script>

</body>
</html>
