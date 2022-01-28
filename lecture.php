<?php 


$nomFichier = "recupDonnees.txt";//je déclare 1 variable $nomFichier à laquelle j affecte le fichier que je veux explorer
//je lui donne en parametre mn fichier à explorer (affecté dns la variable $nomFichier)
$folder = file($nomFichier); //file() est 1 fonction prédéfinie qui permet d ouvrir 1 fichier et retourner sn contenu ss la forme d1 tableau 

//j affiche ls infos contenues dns $folder avc 1 print_r 
echo "<pre>"; 
    print_r($folder);
echo "</pre>"; 

//affichage conventionnel ds données collectées grace à 1 boucle foreach
foreach ($folder as $ligne) {
    echo $ligne . "<br>";
}

//encore 1 autre affichage possible de ces donnés grace à implode
echo implode(' / ', $folder);
//implode = ecrire en ligne ls résultat d1 tableau

?>