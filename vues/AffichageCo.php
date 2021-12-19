<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="test.css">
</head>

<?php $dVueEreur=[];     //Initialisation du tableau d'erreur ?>
<?php echo 'vous etes connecte '.$_SESSION['login']; ?>

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

     <label for="isPub">
                Rendre privé : <input type="checkbox" name="isPub" > <br><br>
     </label>

    <input type="submit" value="Accept" >
    </p>
</form>
<article>
<?php
require_once("modeles/Tache.php");
require("vues/Affichage.php");

// ** Base de donnée ** //
require("modeles/TacheGateway.php");
require("modeles/ListeGateway.php");
require("config/config.php");

try{
    $con = new Connection($dns, $user, $mdp);
}catch(PDOException $e1){
    $dVueEreur[]=$e1->getMessage();
}

$gateway = new TacheGateway($con);
$gatewayList = new ListeGateway($con);

// ** Affichage * //

$TTache=$gateway->afficherTout($_SESSION['login']);

require("vues/AffichageVisiteur.php");


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