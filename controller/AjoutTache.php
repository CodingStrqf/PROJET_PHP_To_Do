<?php
require_once('../modeles/Tache.php');

//traitement
$connect=$_POST['estConnecte'];

$tache= $_POST['tache'] ?? 'pasdetache';
$date= $_POST['date'] ?? '';
$import= $_POST['import'] ?? '';

if(empty($_POST['isPub'])){
    $isPublic = 1;
}else{
    $isPublic = 0;
}
$idTache = 0;

if(empty($_POST['newList'])){
    $liste= $_POST['liste'];
}else{
    $liste= $_POST['newList'];
    $newList=1;
}

//filter_var nettoyage
$contenu=filter_var($tache, FILTER_SANITIZE_STRING);
$date=filter_var($date, FILTER_SANITIZE_STRING);
$importance=filter_var($import, FILTER_SANITIZE_STRING);
$liste=filter_var($liste, FILTER_SANITIZE_STRING);


// ** Base de donnée ** //

require("../modeles/Connection.php");
require("../modeles/TacheGateway.php");
require("../modeles/ListeGateway.php");
require("../config/config.php");
try{
    $con = new Connection($dns, $user, $mdp);
}catch(PDOException $e){
    $dVueEreur[]=$e->getMessage();
}
require("../vues/erreur.php");


$gateway = new TacheGateway($con);
$gatewayList = new ListeGateway($con);

//insertion
if($newList==1){
    $gatewayList->insert($liste, 'adrien');
    $liste='adrien'.$liste;
}
$gateway->insert($idTache,$contenu,$date,$importance,$isPublic,$liste);


header('Location:../index.php?estConnecte='.$connect);
?>

