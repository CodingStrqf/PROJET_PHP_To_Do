<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="test.css">
</head>

<?php
//appel au contôleur
$dVueEreur=[];     //Initialisation du tableau d'erreur
?>
<form method="post">
    <?php
    if($co = $_GET['estConnecte']){
        echo 'vous etes connecte';
        ?><input type="submit" name="ecranCo" value="deconnection"><?php
    }else{
        echo 'vous etes visiteur';
        ?><input type="submit" name="ecranCo" value="connection"><?php
    }
    ?>
</form>


<h1> To Do List</h1>
<body>
<span  class="corp">

<form action="controller/AjoutTache.php" method="post">
<p>
    <h2> Ajouter tache </h2>

    <label for="tache" >
        Tache : <input type="text" name="tache"> <br>
    </label>

    <label for="date" >
        Date : <input type="text" name="date"> <br>
    </label>

    <label for="import">
        Importance : <select name="import">
            <option value="#FF0000">Important</option>
            <option value="#FFA600">Moyennement important</option>
            <option value="#00FF94">Pas important</option>
        </select>
    </label>


    <label for="newList" >
        Liste : <input type="text" name="newList"> <br>
    </label>

     <?php

     if ($co == '0'){
         echo '
            <label for="isPub">
                Rendre privé : vous n\'etes pas connecte, vous ne pouvez pas faire ca <br><br>
                <input type="hidden" name="isPub" value="" >
            </label>';
     }else{
         echo '
            <label for="isPub">
                Rendre privé : <input type="checkbox" name="isPub" > <br><br>
            </label>';
     }
     ?>

    <input type="submit" value="Accept" >
    <input type="hidden" name="estConnecte" value="<?php echo $co ?>">
    </p>
</form>


<article>
<?php
require_once("modeles/Tache.php");


require("vues/Affichage.php");

// ** Base de donnée ** //

require("modeles/Connection.php");
require("modeles/TacheGateway.php");
require("modeles/ListeGateway.php");
require("config/config.php");
try{
    $con = new Connection($dns, $user, $mdp);
}catch(PDOException $e){
    $dVueEreur[]=$e->getMessage();
}
require("vues/erreur.php");


$gateway = new TacheGateway($con);
$gatewayList = new ListeGateway($con);

// ** Affichage * //

$TTache=$gateway->afficherTout($co, 'adrien');


if($co = $_GET['estConnecte']){
    require("vues/Affichage.php");
}else{
    require("vues/AffichageVisiteur.php");
}


?>
</article>
</span>
</body>
</html>
<?php
if(isset($_POST['ecranCo'])){
    header('Location:../PROJET_PHP_To_Do/vues/AffichageConnection.php');
}
?>