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
require("../Connection.php");
require("../TacheGateway.php");
require("../config/config.php");
require_once ("../ConnectionGateway.php");

try{
    $con = new Connection($dns, $user, $mdp);
}catch(PDOException $e1){
    $dVueEreur[]=$e1->getMessage();
}
require("../vues/erreur.php");

$gateway = new ConnectionGateway($con);


if(isset($_POST['envoyer'])) {

    $id = $_POST['id'];
    $mdp = $_POST['mdp'];
    $exist = $gateway->rechercheUtil($id,$mdp);

    if($exist) {
        $estConnecte = 1;
        header('Location:../index.php?estConnecte='.$estConnecte);
    }else{
        echo 'problème de login ou de mdp';
    }

}
if(isset($_POST['pasCo'])){
    $estConnecte = 0;
    header('Location:../index.php?estConnecte='.$estConnecte);
}
    ?>

</body>
</html>

