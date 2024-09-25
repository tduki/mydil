<?php
session_start();

// Fonction pour convertir l'ID du type d'utilisateur en texte
function getUserTypeText($userTypeId) {
    switch ($userTypeId) {
        case 1:
            return 'User';
        case 2:
            return 'Responsable';
        case 3:
            return 'Admin';
        default:
            return 'Inconnu';
    }
}
?>

<style>
    /* Ajout de la couleur bleu clair */
    .navbar-custom {
        background-color: #ADD8E6; /* Bleu clair */
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> <img src="../img/logo.png" alt="Logo Mydil" width="90" height="80" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>

                    <!-- Lien pour les Admins -->
                    <?php if ($_SESSION['user_type'] == 3): ?> 
                        <li class="nav-item">
                            <a class="nav-link" href="../vue/ihm_admin.php">Panel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../vue/ihm_config.php">Configuration materiel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../vue/ihm_global.php">Materiel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../vue/ihm_historique">Historique</a>
                        </li>
                    <?php endif; ?>

                  <!-- Lien pour les Responsables -->
                    <?php if ($_SESSION['user_type'] == 2): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Réservation totale</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Réserver</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Historique</a>
                        </li>
                    <?php endif; ?>

                    <!-- Lien commun pour tous les utilisateurs connectés -->
                    <li class="nav-item">
                            <a class="nav-link" href="../vue/ihm_reservation.php">Réserver du materiel</a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../vue/ihm_reservation_personne.php">Mes Réservations</a>
                    </li>

                    <!-- Lien de déconnexion avec type et nom de l'utilisateur -->
                    <li class="nav-item">
                        <a class="nav-link" href="../script/deconnexion.php">
                            Déconnexion (<?= getUserTypeText($_SESSION['user_type']) ?>)
                        </a>
                    </li>
                <?php else: ?>
                    <!-- Lien pour les utilisateurs non connectés -->
                    <li class="nav-item">
                        <a class="nav-link" href="../vue/ihm_connexion.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../vue/ihm_inscription.php">Inscription</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
