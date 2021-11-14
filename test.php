<!DOCTYPE html>
<html lang="fr">
<h1> To Do List</h1>
<body>

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

</p>
</form>



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
echo "Tout marche ici";
require("AjoutTache.php");
?>
</body>
</html>
