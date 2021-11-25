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

$t1 = new Tache("Faire dodo","14/11/2021","3",1);
$t2 = new Tache("Jouer à Valorant","14/11/2021","2",1);
$t3 = new Tache("dire bonjour à Léo","14/11/2021","1",0);

$TTache=[
    "1"=>$t1,
    "2"=>$t2,
    "3"=>$t3
];
require("vues/Affichage.php");

// ************************* Base de donnée ********************************* //

require("Connection.php");
require("TacheGateway.php");

$dsn = 'mysql:host=localhost;dbname=projet_php_to_do';
$user = 'addenonfou';
$password = 'Adrien.202';
$ad = new PDO($dsn, $user, $password);
$gateway = new TacheGateway(new Connection($dsn, $user, $password));

// ************************* Ajout ********************************* //

$id = 0;
$contenu = 'Faire la base de donnée';
$date='2021-11-17';
$importance='3';
$isPublic=3;


//$id = $gateway->insert($id,$contenu,$date,$importance,$isPublic);

// ************************* Suppression ********************************* //

//$gateway->delete(1);

// ************************* Affichage ********************************* //

$TTache=$gateway->afficherTout();
require("vues/Affichage.php");
?>
</article>
</span>
</body>
</html>
