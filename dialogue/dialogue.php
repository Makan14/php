<?php 
//connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=dialogue', 'root', '', array(
    
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
));

$erreur = "";

if ($_POST) {
    //syntaxe pr 1 preg_match() qui permet ls caracteres spéciaux ._-
    if (!isset($_POST['pseudo']) || !preg_match("#^[a-zA-Z0-9._-]{1,20}$#", $_POST['pseudo'])) {
        $erreur .= '<div class="alert alert-danger"role="alert">Erreur format pseudo</div>';
    }

    // vérification du champs message. 
    if(!isset($_POST['message']) || iconv_strlen($_POST['message']) < 2 || iconv_strlen($_POST['message']) > 300 ){
        $erreur .= '<div class="alert alert-danger"role="alert">Erreur format message</div>';
    }

    if (empty($erreur)) {
        $ajoutMessage = $pdo->prepare("INSERT INTO commentaire (pseudo, message, date_enregistrement) VALUES (:pseudo, :message, NOW())");

        $ajoutMessage->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $ajoutMessage->bindValue(':message', $_POST['message'], PDO::PARAM_STR);
        $ajoutMessage->execute();
    }
}

//-------------------------------------pour recuperer la date-------------
$requeteCommentaires = $pdo->query("SELECT pseudo, message, DATE_FORMAT(date_enregistrement, '%d/%m/%Y') AS dateFr, DATE_FORMAT(date_enregistrement, '%H/%i/%s') AS heureFr FROM commentaire ORDER BY date_enregistrement DESC");
$commentaires = $requeteCommentaires->fetch(PDO::FETCH_ASSOC);
?>

<!-- -----------------------------------------DOCTYPE----------------- -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Formulaire de Dialogue</title>
</head>
<body class="container bg-danger">

    <h1 class="my-5 text-center">Espace de dialogue</h1>

    <?= $erreur ?>

    <?php  
    $date_debut = strtotime($commentaires['created_at']);
      
    ?>
    
    <!------------------------------------- Formulaire -->
    
    <form class="py-5" method="POST" action="">

        <div class="mb-3 col-12">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="Votre pseudo">
        </div>

        <div class="mb-3 col-12">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="3" placeholder="Votre message"></textarea>
        </div>

<!------------------------------------------- Bouton envoyer -->
        <button type="submit" class="btn btn-primary col-12">Envoyer</button>
    
    </form>
    
    <h2 class="text-center ms-5"><?= $requeteCommentaires->rowCount() ?> messages envoyés</h2>

    <!------------------------------------------------ pour recupérer les données avec la boucle while -->
    <?php while($commentaires = $requeteCommentaires->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="blockquote col-md-6 mx-auto p-5 text-justify shadow mt-5 bg-white
                rounded">
                <h3 class="mb-5"> Par: <?= $commentaires['pseudo'] ?> . Posté le : <?= $commentaires['dateFr'] ?> à <?= $commentaires['heureFr'] ?> </h3>
                    <p>Commentaire:</p>
                    <p> <?= $commentaires['message'] ?> </p>
            </div>

    <?php endwhile ?>;

    
    <!-- cdn bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>