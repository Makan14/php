<?php  

$pdo = new PDO('mysql:host=localhost;dbname=securite', 'root', '', array(
    
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
));

//en cas d envoi de données dns le formulaire (if($_POST))
if ($_POST) {
    //avc 7 requete je vais aller comparer le pseudo send dns le formulaire avc 1 pseudo similaire existant en BDD
    $rechercheMembre = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]' AND mdp = '$_POST[mdp]' ");
    $membre = $rechercheMembre->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">   
    <title>Page de Connexion</title>
</head>
<body class="container bg-success">
    
<h1 class="my-5 text-center">Espace Connexion</h1>

<form class="py-5" method="post">
    <div class="mb-3 col-5 mx-auto">
        <label for="pseudo" class="form-label">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Votre pseudo">
    </div>
    
    <div class="mb-3 col-5 mx-auto">
        <label for="mdp" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Votre mot de passe">
	</div>

    <button type="submit" class="btn btn-primary col-5 text-center">Envoyer</button>
</form>

<?php if($_POST): ?>
    <h2 class="my-5 text-primary">Votre Profil</h2>
    <?php if(!empty($membre)): ?>
        <?= print_r($rechercheMembre) ?>
        <h3>Félicitations, vous êtes connecté</h3>
        <p>Vous êtes: <?= $membre['pseudo'] ?></p>
        <p>Votre email est: <?= $membre['email'] ?></p>
    <?php else: ?>
        <h3 class="text-danger">Votre connexion a échoué</h3>
    <?php endif ?>
<?php endif; ?>

    <!-- cdn bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>