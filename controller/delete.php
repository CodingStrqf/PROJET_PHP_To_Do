<?php
require_once('../modeles/Tache.php');

$idTache= $_POST['delete'];
$connect=$_POST['estConnecte'];

// ** Base de donnée ** //

require("../modeles/Connection.php");
require("../modeles/TacheGateway.php");
require("../modeles/ListeGateway.php");
require("../config/config.php");
try{
    $con = new Connection($dns, $user, $mdp);
}catch(PDOException $e1){
    $dVueEreur[]=$e1->getMessage();
}
require("../vues/erreur.php");
$gateway = new TacheGateway($con);
$gatewayList = new ListeGateway($con);

//suppression
$tache= $gateway->findByIdTache($idTache);
$idListe=$tache[0][5];

$gateway->delete($idTache);
if(($gateway->isEmpty($idListe))==0){
    $gatewayList->delete($idListe);
}




header('Location:../index.php?estConnecte='.$connect);
?>
