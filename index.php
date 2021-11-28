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
<?php
if($co = $_GET['estConnecte']){
    echo 'connecte';
}else{
    echo 'pas connecte';
}
?>

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
            <option value="3">Important</option>
            <option value="2">Moyennement important</option>
            <option value="1">Pas important</option>
        </select>
        <br>
    </label>

    <label for="isPub">
        Rendre privé : <input type="checkbox" name="isPub"> <br><br>
    </label>
    <input type="submit" value="Accept" >
    <input type="hidden" name="update" value="<?php echo $co ?>">
</p>
</form>


<article>
<?php
require_once("modeles/Tache.php");

// ************************* Exemples de tache ********************************* //

require("vues/Affichage.php");

// ************************* Base de donnée ********************************* //

require("Connection.php");
require("TacheGateway.php");
require("config/config.php");
try{
    $con = new Connection($dns, $user, $mdp);
}catch(PDOException $e1){
    $dVueEreur[]=$e1->getMessage();
}
require("vues/erreur.php");


$gateway = new TacheGateway($con);

// ************************* Ajout ********************************* //

$idTache = 0;
$contenu = 'aller dehors';
$date='25/11/2021';
$importance='1';
$isPublic=1;


//$gateway->insert($idTache,$contenu,$date,$importance,$isPublic);

// ************************* Suppression ********************************* //

//$gateway->delete(21);

// ************************* Suppression ********************************* //
/*
$idTache = 18;
$contenu = 'Acheter des mouchoires';
$date='26/08/2020';
$importance='3';
$isPublic=0;

//$gateway->update($idTache, $contenu, $date, $importance, $isPublic);
*/
// ************************* Affichage ********************************* //

$TTache=$gateway->afficherTout($co);
require("vues/Affichage.php");
?>
</article>
</span>
</body>
</html>
