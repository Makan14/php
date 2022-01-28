<?php 

if($_POST){
    echo "<ul>";
        echo "<li>prénom: $_POST[prenom]</li>";
        echo "<li>description: $_POST[description]</li>";
        echo "<li>année de naissance: $_POST[annee]</li>";
    echo "</ul>";

    //fopen() permet d ouvrir 1 fichier
    // il prend  2 arguments. le 1er le nom du fichier. le second le mode d ouberture 'a'
    //le mode d ouverture permet d ouvrir 1 fichier, mais s il n existe ps encore, il va le créer
    $fichier = fopen('recupDonnees.txt', 'a');
    // fwrite() me permet  d ecrire dns ce fichier
    //elle prend 2 arguments le 1er le fichier ouvert ($fichier) le second argument sera le contenu a ecrire dns le fichier.
    fwrite($fichier, "Prénom: " . $_POST['prenom'] . "\n");
    fwrite($fichier, "Déscription: " . $_POST['description'] . "\n");
    fwrite($fichier, "Année de naissance: " . $_POST['annee'] . "\n");
    //la ligne ci desss me sert de séparateur entre chaque nouvel envoi du formulaire par 1 nvl utilisateur
    fwrite($fichier, "-----------------\n");
    //le \n est 1 équivalent de <br>, retour à la ligne

    //fclose() va fermer le fichier, avc en argument, le fichier à fermer
    $fichier = fclose($fichier);
}

?>