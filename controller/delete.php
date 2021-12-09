<?php
require_once('modeles/Tache.php');

$idTache= $_POST['delete'];
$connect=$_POST['estConnecte'];


//insertion
$gateway->delete($idTache);

header('Location:../index.php?estConnecte='.$connect);
?>
