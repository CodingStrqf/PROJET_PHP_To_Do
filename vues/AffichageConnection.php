<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="test.css">
</head>
<body>

<form method="post">
    Id : <input type="text" name="id"> <br>
    Mot de passe : <input type="text" name="mdp"> <br>
    <input type="submit" name="envoyer" value="Connection"> <input type="submit" name="pasCo" value="ne pas se connecter">
</form>

<?php
require_once ("modeles/TacheGateway.php");
require_once ("vues/erreur.php");

if(isset($_POST['envoyer'])) {

    $id = $_POST['id'];
    $mdp = $_POST['mdp'];
    $exist = $gatewayConnection->rechercheUtil($id,$mdp);


    if($exist) {

        $_SESSION['login'] = filter_var($id, FILTER_SANITIZE_STRING);
    }else{
        echo 'problème de login ou de mdp';
    }

}
if(isset($_POST['pasCo'])){

    $_SESSION['login'] = "visiteur";
//    header('Location:../index.php?estConnecte='.$estConnecte);
}

?>

</body>
</html>

