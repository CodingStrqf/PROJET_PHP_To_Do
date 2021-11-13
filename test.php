<!DOCTYPE html>
<html lang="fr">
<h1> To Do List</h1>
<body>

<?php
require("Tache.php");

$t1 = new Tache("Faire dodo","14/11/2021","#FF0000",1);
$t2 = new Tache("Jouer à Valorant","14/11/2021","#FFA600",1);
$t3 = new Tache("dire bonjour à Léo","14/11/2021","#00FF94",0);


$TTache=[
    "1"=>$t1,
    "2"=>$t2,
    "3"=>$t3
];

require("Affichage.php");

echo "Tout marche ici";

?>

</body>
</html>
