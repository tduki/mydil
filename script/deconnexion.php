<?php
session_start();
session_unset();
session_destroy();
header('Location: ../vue/ihm_connexion.php'); 
exit();
?>