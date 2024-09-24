<?php
session_start();
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
                    <?php if ($_SESSION['user_type'] == 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Panel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Réservation total</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Réserver</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Historique</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION['user_type'] == 'user'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Réserver</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION['user_type'] == 'responsable'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Réservation total</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Réserver</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Historique</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mes Réservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                    </li>
                <?php else: ?>
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
