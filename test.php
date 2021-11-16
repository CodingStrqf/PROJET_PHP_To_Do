<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="test.css">
</head>

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
        Importance : <input type="text" name="import">  <br>
    </label>
    <button>Accept</button>
</p>
</form>


<article>
<?php
require("Tache.php");


$t1 = new Tache("Faire dodo","14/11/2021","rouge",1);
$t2 = new Tache("Jouer à Valorant","14/11/2021","orange",1);
$t3 = new Tache("dire bonjour à Léo","14/11/2021","vert",0);

$TTache=[
    "1"=>$t1,
    "2"=>$t2,
    "3"=>$t3
];
require("Affichage.php");

require("AjoutTache.php");
?>
</article>
</span>
</body>
</html>
