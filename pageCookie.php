<div>
    <!-- pr chacun drpeau cliquable je vais faire transiter via la balise <a> (dns sn attribut href) une valeur affiliée à l indice pays (pays=en, pays=es etc...) -->
    <a href="?pays=en"> <img src="img/england.png" loading="lazy" alt="drapeau de l angleterre"> </a>
    <a href="?pays=es"> <img src="img/spain.png" loading="lazy" alt="drapeau de l espagne"> </a>
    <a href="?pays=dz"> <img src="img/algeria.png" loading="lazy" alt="drapeau de l algérie"> </a>
</div>

<?php  
//je start avc 1 condition pr vérifier si l indice pays existe ou pas dns l url. Le isset est important ici pr cela. Si je ne l utilise pas, alors PHP s attend à le trouver dès le 1er chargement de la page, ce ce qui ne sera pas possible (je n'ai again cliqué sur aucun drapeau), il me renverra 1 erreur warning.
if (isset($_GET['pays'])) {
    //si dnc il trouve cet indice dns l url, il affectera alors à la variable $pays la valeur de cet indice (en, es ou dz)
    $pays = $_GET['pays'];
    //dns le elseif je vais vérif 1 autre cas de figure celui ou 1 cookie existe, (qui porte le nom de pays) existe déjà (déjà crée lors d 1 préc visite sur le site)
}elseif(isset($_COOKIE['pays'])){
    //si ce cookie existe alors $pays se verra affectée de la valeur qui a été stockée dns ce cookie 
    $pays = $_COOKIE['pays'];
    //il reste le else le cas de figure ou encore aucune information n a transité  dns l URL et aucun cookie existe
}else{
    //dns ce cas là, la variable $pays se verra affectée de la valeur 'fr' ce qui entrainera par le biais de ma condition switch l affichage du mot bjr
    $pays = 'fr';
}

//la fonction setcookie permet de créer le cookie
//elle dmande 3 parametre dns l ordre le nom du cookie (pays) le nom de la variable qui va stocker la valeur du cookie ($pays) et en dernier la durée de vie du cookie. Ici cst le calcul pr 1 durée de 1 an
//avc time() je prend la date d aujd exprimée en seconde et je lui additionne 3600 secondes (dns 1 heure) multiplié à 24h(dns 1 journée) multp à 365jrs(pr faire 1 année)
setcookie('pays', $pays, time()+3600*24*365);
//désormais mon cookie est crée, je peux le retrouver stocké dns mn navigateur. Et si je quitte mn onglet voire mm le navigateur, lors de ma prochaine visite sur le site, $_COOKIE retrouvera l existance de ce cookie et récupérera la valeur stockée (le elseif de la condition au-dessus)
//le cookie se régénère automatiquement pr 1 année à chaque visite de votre part sur le site
//pr qu il s auto-détruire au bout d1 an il faudrait que vs n y allez pls durant tte cette période. 

//dns cette switch je vais tester ma variable $pays
switch ($pays) {
    case 'fr':
        //dns le cas ou elle a été affectée de la valeur fr, (dns le else) il sera affiché bjr en accueil 
        echo "<h1>Bonjour</h1>";
        break;

        //dns le cas ou elle a été affectée de la valeur fr, (dns le else) il sera affiché welcome en accueil
    case 'en':
        echo "<h1>Welcome</h1>";
        break;

        //dns le cas ou elle a été affectée de la valeur fr, (dns le else) il sera affiché hola en accueil
    case 'es':
        echo "<h1>Hola</h1>";
        break;

        //dns le cas ou elle a été affectée de la valeur fr, (dns le else) il sera affiché salaam en accueil 
    case 'dz':
        echo "<h1>Salaam</h1>";
        break;
    
    default:
        echo "<h1>Vous n'avez choisi aucune langue</h1>";
        break;
}

?>