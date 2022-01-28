<?php 

if($_GET){
    echo $_GET['produit'] . " au " . $_GET['variete'] . "<br>";
    echo "Vendu " . $_GET['prix'] . "€, aujourd'hui seulement <br>";
}



?>