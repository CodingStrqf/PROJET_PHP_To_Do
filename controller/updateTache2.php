<?php
require_once('modeles/Tache.php');


//traitement
$connect=$_POST['estConnecte'];

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




$gateway->update($idTache,$contenu,$date,$importance,$isPublic);


header('Location:../index.php?estConnecte='.$connect);
?>