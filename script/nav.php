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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Mydil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>

                    <!-- Lien pour les Admins -->
                    <?php if ($_SESSION['user_type'] == 3): ?> 
                        <li class="nav-item">
                            <a class="nav-link" href="#">Panel</a>
                        </li>
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

                    <!-- Lien pour les Users -->
                    <?php if ($_SESSION['user_type'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Réserver un article</a>
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
                        <a class="nav-link" href="#">Mes Réservations</a>
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
