<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="test.css">
</head>

<?php
//appel au contôleur
?>

<h1> To Do List</h1>
<body>
<span  class="corp">

<form action="AjoutTache.php" method="post">
<p>
    <h2> Ajouter tache </h2>

    <label for="tache" >
        Tache : <input type="text" name="tache"> <br>
    </label>

    <label for="date" >
        Date : <input type="text" name="date"> <br>
    </label>

    <label for="import">
        Importance : <input type="text" name="import">  <br> <br>
    </label>
    <button>Accept</button>
</p>
</form>


<article>
<?php
require_once("modeles/Tache.php");

// ************************* Exemples de tache ********************************* //

$t1 = new Tache(0,"Faire dodo","14/11/2021","3",1);
$t2 = new Tache(0,"Jouer à Valorant","14/11/2021","2",1);
$t3 = new Tache(0,"dire bonjour à Léo","14/11/2021","1",0);

$TTache=[
    "1"=>$t1,
    "2"=>$t2,
    "3"=>$t3
];
require("vues/Affichage.php");

// ************************* Base de donnée ********************************* //

require("Connection.php");
require("TacheGateway.php");
require("config/config.php");

try {
    $con = new Connection($dns, $user, $mdp);
}
catch(PDOException $e1){
    echo $e1->getMessage();
}

$gateway = new TacheGateway($con);

// ************************* Ajout ********************************* //

$idTache = 0;
$contenu = 'Aller me moucher';
$date='2021-11-25';
$importance='2';
$isPublic=1;


//$gateway->insert($idTache,$contenu,$date,$importance,$isPublic);

// ************************* Suppression ********************************* //

//$gateway->delete(16);

// ************************* Suppression ********************************* //

$idTache = 18;
$contenu = 'Acheter des mouchoir';
$date='2021-11-25';
$importance='3';
$isPublic=0;

$gateway->update($idTache, $contenu, $date, $importance, $isPublic);

// ************************* Affichage ********************************* //

$TTache=$gateway->afficherTout();
require("vues/Affichage.php");
?>
</article>
</span>
</body>
</html>
