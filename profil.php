<?php 

session_start();

require_once('inc/header.inc.php');

echo "<h1 class='my-5 text-center'>Page profil</h1>";

if (isset($_SESSION)) {
    echo "Bienvenu " . $_SESSION['prenom'] . " , vous avez le statut d' " . $_SESSION['statut'] . " sur ce site !";
}



?>








<?php require_once('inc/footer.inc.php');?>
