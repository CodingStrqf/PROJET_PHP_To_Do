<?php

class VisiteurController
{
    public function __construct()
    {
        global $rep, $vues;

        try {
            $action = $_REQUEST['action'] ?? null;
            switch ($action) {
                case "ajouter":
                    $this->ajouterTache();
                    break;
                case "supprimer":
                    $this->supprimerTache();
                    break;
                case "modifier":
                    $this->modifierTache();
                    break;
                case "connection":
                    $this->connection();
                    break;
                default:
                    $this->afficherTache();
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
    public function connection(){
        global $rep, $vues;
        require($rep.$vues["connection"]);
    }

    public function afficherTache(){
        global $rep, $vues,$con;
        $gatewayTache = new TacheGateway($con);
        $gatewayList = new ListeGateway($con);
        // ** Affichage * //

        require($rep.$vues["visiteur"]);


        $TTache=$gatewayTache->afficherTout(null);

        
        foreach ($TTache as $row ){

            if($row!=null){
                $nom=$gatewayList->findByIdListe($row[0]->getIdListe());
                echo "Liste : $nom[0]";
                foreach ($row as $value) {
                    require($rep.$vues["affichageTache"]);
                }
            }
        }
    }

    public function ajouterTache(){

    }

    public function supprimerTache(){

    }

    public function modifierTache(){

    }
}