<?php
require_once('../modeles/Tache.php');

//traitement
$connect=$_POST['estConnecte'];

$liste= $_POST['liste'];
$tache= $_POST['tache'] ?? 'pasdetache';
$date= $_POST['date'] ?? '';
$import= $_POST['import'] ?? '';

if(empty($_POST['isPub'])){
    $isPublic = 1;
}else{
    $isPublic = 0;
}
$idTache = 0;

//filter_var nettoyage
$contenu=filter_var($tache, FILTER_SANITIZE_STRING);
$date=filter_var($date, FILTER_SANITIZE_STRING);
$importance=filter_var($import, FILTER_SANITIZE_STRING);


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
$gateway->insert($idTache,$contenu,$date,$importance,$isPublic,$liste);


header('Location:../index.php?estConnecte='.$connect);
?>

