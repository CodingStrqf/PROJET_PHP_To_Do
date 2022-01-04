<?php

class Validation {

    static function val_action($action) {

        if (!isset($action)) {
            throw new Exception('pas d\'action');
        }
    }

    public static function validation_tache(string &$contenu, string &$date ,string &$nomListe, array &$dVueEreur) {

        if ($contenu != filter_var($contenu, FILTER_SANITIZE_STRING))
        {
            $dVueEreur[] =	"testative d'injection de code (attaque sécurité)";
            $contenu="";
        }
        if ($date != filter_var($date, FILTER_SANITIZE_STRING))
        {
            $dVueEreur[] =	"testative d'injection de code (attaque sécurité)";
            $date="";
        }
        if ($nomListe != filter_var($nomListe, FILTER_SANITIZE_STRING))
        {
            $dVueEreur[] =	"testative d'injection de code (attaque sécurité)";
            $nomListe="";
        }
    }

    public static function validation_utilisateur(string &$id, string &$mdp, array &$dVueEreur) {

        if (!isset($id)||$id=="") {
            $dVueEreur[] =	"pas d'id<br>";
            $id="";
        }

        if ($id != filter_var($id, FILTER_SANITIZE_STRING))
        {
            $dVueEreur[] =	"testative d'injection de code (attaque sécurité)";
            $id="";

        }

        if (!isset($mdp)||$mdp=="") {
            $dVueEreur[] =	"pas de mot de passe<br>";
            $mdp="";
        }

        if ($mdp != filter_var($mdp, FILTER_SANITIZE_STRING))
        {
            $dVueEreur[] =	"testative d'injection de code (attaque sécurité)";
            $mdp="";

        }

    }

}
?>



        