<?php
if ($_POST["tache"] != NULL){
    $TTache[] = new Tache($_POST["tache"],$_POST["date"],$_POST["import"],1);
}

