<?php
require_once("../modeles/Tache.php");
require("../Connection.php");
require("../TacheGateway.php");
require("../config/config.php");

$idTache= $_POST['delete'];
$connect=$_POST['estConnecte'];

//connection
try {
    $con = new Connection($dns, $user, $mdp);
} catch(PDOException $e){
    $dVueEreur[]=$e->getMessage();
}
require("../vues/erreur.php");

$gateway = new TacheGateway($con);
//insertion
$gateway->delete($idTache);

header('Location:../index.php?estConnecte='.$connect);
?>
