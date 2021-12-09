<?php
require_once('../modeles/Tache.php');

$idTache= $_POST['delete'];
$connect=$_POST['estConnecte'];

// ** Base de donnée ** //

require("../modeles/Connection.php");
require("../modeles/TacheGateway.php");
require("../config/config.php");
try{
    $con = new Connection($dns, $user, $mdp);
}catch(PDOException $e1){
    $dVueEreur[]=$e1->getMessage();
}
require("../vues/erreur.php");
$gateway = new TacheGateway($con);
//insertion
$gateway->delete($idTache);

header('Location:../index.php?estConnecte='.$connect);
?>
