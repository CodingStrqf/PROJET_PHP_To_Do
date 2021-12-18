<?php

if (!empty($TTache)){

    foreach ($TTache as $row ){
        $nom=$gatewayList->findByIdListe($row[0]->getIdListe());
        echo "Liste : $nom[0]";
        foreach ($row as $value) {
            require('vues/affichageDeTache.php');
        }
    }
}


