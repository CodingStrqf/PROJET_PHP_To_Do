<?php

class GestController
{
    public function __construct()
    {
        global $rep, $vues;

        try {
            $action = $_REQUEST['action'];
            switch ($action) {
                case NULL:
                    $this->afficherTache();
                    break;
                case "ajouter":
                    $this->ajouterTache();
                    break;
                case "supprimer":
                    $this->supprimerTache();
                    break;
                case "modifier":
                    $this->modifierTache();
                    break;
            }
        } catch (PDOException $e) {
            //si erreur BD, pas le cas ici
            $dataVueEreur[] = "Erreur inattendue!!! ";
            require($rep . $vues['erreur']);
        } catch (Exception $e2) {
            $dataVueEreur[] = "Erreur inattendue!!! ";
            require($rep . $vues['erreur']);
        }
    }
    public function afficherTache(){

    }

    public function ajouterTache(){

    }

    public function supprimerTache(){

    }

    public function modifierTache(){

    }
}