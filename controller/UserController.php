<?php

class UserController
{
    public function __construct($id)
    {
        global $rep, $vues;
        $_SESSION['login'] = $id;
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
                case "deconnection":
                    $this->deconnection();
                    break;
                default:
                    $this->afficherTache();
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
    public function deconnection(){
        global $rep, $vues;
        $_SESSION["login"]=null;
        require($rep.$vues["connection"]);
    }

    public function afficherTache(){
        global $con, $rep, $vues;

        require($rep.$vues["utilisateur"]);

        $gatewayTache = new TacheGateway($con);
        $gatewayList = new ListeGateway($con);
        // ** Affichage * //

        $TTache=$gatewayTache->recupListUtil($_SESSION['login']);
        if (!empty($TTache)){

            foreach ($TTache as $row ){
                $nom=$gatewayList->findByIdListe($row[0]->getIdListe());
                echo "Liste : $nom[0]";
                foreach ($row as $value) {
                    require($rep.$vues["tache"]);
                }
            }
        }
    }

    public function ajouterTache(){
        global $con;

        $tache = $_POST['tache'] ?? 'pasdetache';
        $date = $_POST['date'] ?? '';
        $import = $_POST['import'] ?? '';

        if (empty($_POST['isPub'])) {
            $isPublic = 1;
        } else {
            $isPublic = 0;
        }
        $idTache = 0;

        $nomListe = $_POST['newList'];


        //filter_var nettoyage
        $contenu = filter_var($tache, FILTER_SANITIZE_STRING);
        $date = filter_var($date, FILTER_SANITIZE_STRING);
        $importance = filter_var($import, FILTER_SANITIZE_STRING);
        $nomListe = filter_var($nomListe, FILTER_SANITIZE_STRING);


        $gateway = new TacheGateway($con);
        $gatewayList = new ListeGateway($con);


        if ($gatewayList->getList($_SESSION["login"] . $nomListe) == 1) {
            $idListe = $_SESSION["login"] . $nomListe;
            $gateway->insert($idTache, $contenu, $date, $importance, $isPublic, $idListe);
        } else {
            $idListe = 'adrien' . $nomListe;
            $gatewayList->insert($nomListe, $_SESSION["login"]);
            $gateway->insert($idTache, $contenu, $date, $importance, $isPublic, $idListe);
        }
        $this->afficherTache();
    }

    public function supprimerTache(){
        global $con;

        $idTache = $_POST['delete'];


        $gatewayTache = new TacheGateway($con);
        $gatewayList = new ListeGateway($con);

        //suppression
        $tache = $gatewayTache->findByIdTache($idTache);
        $idListe = $tache[0][5];

        $gatewayTache->delete($idTache);
        if (($gatewayTache->isEmpty($idListe)) == 0) {
            $gatewayList->delete($idListe);
        }
        $this->afficherTache();
    }

    public function modifierTache(){
        global $rep,$vues;
        require($rep.$vues["updateTache"]);

        $idTache = $_POST['idTache'];
        $tache = $_POST['tache'] ?? 'pasdetache';
        $date = $_POST['date'] ?? '';
        $import = $_POST['import'] ?? '';
        if (empty($_POST['isPub'])) {
            $isPublic = 1;
        } else {
            $isPublic = 0;
        }
        $nomListe = $_POST['newList'] ?? '';

        //filter_var nettoyage
        $contenu = filter_var($tache, FILTER_SANITIZE_STRING);
        $date = filter_var($date, FILTER_SANITIZE_STRING);
        $importance = filter_var($import, FILTER_SANITIZE_STRING);
        $nomListe = filter_var($nomListe, FILTER_SANITIZE_STRING);


        $gateway = new TacheGateway($con);
        $gatewayList = new ListeGateway($con);


        $idListe = $_SESSION["login"] . $nomListe;
        if ($gatewayList->getList($idListe) == 1) {
            $gateway->update($idTache, $contenu, $date, $importance, $isPublic, $idListe);
        } else {
            $gatewayList->insert($nomListe, $_SESSION["login"]);
            $gateway->update($idTache, $contenu, $date, $importance, $isPublic, $idListe);
        }


        $IdListes = $gatewayList->getIdListe();
        foreach ($IdListes as $idListe)
            if (($gateway->isEmpty($idListe[0])) == 0) {
                $gatewayList->delete($idListe[0]);
            }
        $this->afficherTache();
    }
}