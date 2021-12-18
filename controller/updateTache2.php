<?php
require_once('../modeles/Tache.php');


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
$nomListe=$_POST['newList'] ?? '';

//filter_var nettoyage
$contenu=filter_var($tache, FILTER_SANITIZE_STRING);
$date=filter_var($date, FILTER_SANITIZE_STRING);
$importance=filter_var($import, FILTER_SANITIZE_STRING);
$nomListe=filter_var($nomListe, FILTER_SANITIZE_STRING);


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


$idListe='adrien'.$nomListe;
if($gatewayList->getList($idListe)==1){
    $gateway->update($idTache,$contenu,$date,$importance,$isPublic,$idListe);
}else{
    $gatewayList->insert($nomListe, 'adrien');
    $gateway->update($idTache,$contenu,$date,$importance,$isPublic,$idListe);
}
//Supprimer l'ancienne liste si plus de taches

$IdListes=$gatewayList->getIdListe();
foreach ($IdListes as $idListe)
if(($gateway->isEmpty($idListe[0]))==0){
    $gatewayList->delete($idListe[0]);
}



header('Location:../index.php?estConnecte='.$connect);
?>