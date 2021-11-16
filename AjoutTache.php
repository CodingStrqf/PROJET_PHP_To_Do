<?php
/*
if (isset($_POST['tache'])){
    $TTache[] = new Tache($_POST['tache'],$_POST['date'],$_POST['import'],1);
}
*/
require("Tache.php");
$tache= $_POST['tache'] ?? 'pasdetache';
$date= $_POST['date'] ?? '';
$import= $_POST['import'] ?? '';

//filter_var nettoyage
$tache=filter_var($tache, FILTER_SANITIZE_STRING);
$date=filter_var($date, FILTER_SANITIZE_STRING);
$import=filter_var($import, FILTER_SANITIZE_STRING);

$t = new Tache($tache,$date,$import,1);
$TTache[] = $t;
echo $t->__toString();
?>
