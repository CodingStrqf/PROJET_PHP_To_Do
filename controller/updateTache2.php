<?php
require_once("../modeles/Tache.php");
require("../Connection.php");
require("../TacheGateway.php");
require("../config/config.php");

//traitement

$idTache=$_POST['idTache'];
$tache= $_POST['tache'] ?? 'pasdetache';
$date= $_POST['date'] ?? '';
$import= $_POST['import'] ?? '';
if(empty($_POST['isPub'])){
    $isPublic = 1;
}else{
    $isPublic = 0;
}


//filter_var nettoyage
$contenu=filter_var($tache, FILTER_SANITIZE_STRING);
$date=filter_var($date, FILTER_SANITIZE_STRING);
$importance=filter_var($import, FILTER_SANITIZE_STRING);


//connection
try {
    $con = new Connection($dns, $user, $mdp);
} catch(PDOException $e){
    $dVueEreur[]=$e->getMessage();
}
require("../vues/erreur.php");

$gateway = new TacheGateway($con);

$gateway->update($idTache,$contenu,$date,$importance,$isPublic);


header('Location:../index.php');
?>