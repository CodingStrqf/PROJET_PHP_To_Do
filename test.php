<?php
require("Tache.php");

$t1 = new Tache("Faire dodo","14/11/2021","rouge");
$t2 = new Tache("Jouer à Valorant","14/11/2021","orange");
$t3 = new Tache("dire bonjour à la mère à Léo","14/11/2021","vert");


$TTache=[
    "1"=>$t1,
    "2"=>$t2,
    "3"=>$t3
];

require("Affichage.php");

echo "Tout marche ici";