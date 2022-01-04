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
                case "confirmerTache":
                    $this->confirmerTache();
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

        require($rep.$vues["visiteur"]);

        $gatewayTache = new TacheGateway($con);
        $gatewayList = new ListeGateway($con);
        // ** Affichage * //



        $TTache=$gatewayTache->recupListUtil("visiteur");

        if (!empty($TTache)){

            foreach ($TTache as $row ){
                if($row!=null) {
                    $nom = $gatewayList->findByIdListe($row[0]->getIdListe());
                    echo "Liste : $nom[0]";
                    foreach ($row as $value) {
                        require($rep . $vues["tache"]);
                    }
                }
            }
        }
    }

    public function ajouterTache(){
        global $con, $rep, $vues;
        $dVueEreur=[];

        $tache = $_POST['tache'] ?? 'pasdetache';
        $date = $_POST['date'] ?? '';
        $importance = $_POST['import'] ?? '';
        $isPublic = 1;
        $idTache = 0;
        $nomListe = $_POST['newList'];

        switch (null){
            case $tache:
                $message='veuillez rentrer un nom de tache';
                echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
                break;
            case $date:
                $message='veuillez rentrer une date';
                echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
                break;
            case $nomListe:
                $message='veuillez rentrer un nom de liste';
                echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
                break;
            default:
                if (empty($_POST['isPub'])) {
                    $isPublic = 1;
                } else {
                    $isPublic = 0;
                }
                $idTache = 0;

                //filter_var nettoyage
                Validation::validation_tache($tache, $date, $nomListe, $dVueEreur);
                if(!empty($dVueEreur)){
                    require($rep . $vues["erreur"]);
                }else{
                    $gateway = new TacheGateway($con);
                    $gatewayList = new ListeGateway($con);


                    if ($gatewayList->getList("visiteur" . $nomListe) == 1) {
                        $idListe = "visiteur" . $nomListe;
                        $gateway->insert($idTache, $tache, $date, $importance, $isPublic, $idListe);
                    } else {
                        $idListe = "visiteur" . $nomListe;
                        $gatewayList->insert($nomListe, "visiteur");
                        $gateway->insert($idTache, $tache, $date, $importance, $isPublic, $idListe);
                    }
                }

                break;

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
        global $rep,$vues,$con;

        $idTache = $_POST['update'];
        $gateway = new TacheGateway($con);

        //insertion
        $gatewayList = new ListeGateway($con);
        $tab = $gateway->findByIdTache($idTache);

        foreach ($tab as $row) {
            $tache = new Tache($row['idTache'], $row['contenu'], $row['date'], $row['importance'], $row['isPublic'], $row['idListe']);
        }

        $date = date_create_from_format("Y-m-d", $tache->getDate())->format("d/m/Y");

        $IdTache = $tache->getIdTache();
        $contenu = $tache->getContenu();
        $importance = $tache->getCouleur();
        $isPublic = $tache->getIsPublic();
        $idListe = $tache->getIdListe();

        $nom = $gatewayList->findByIdListe($idListe);


        require($rep.$vues["updateTacheVisiteur"]);   //Appel de la vue
    }

    public function confirmerTache(){
        global $con,$rep,$vues;

        $dVueEreur=[];

        $idTache = $_POST['idTache'];
        $tache = $_POST['tache'] ?? 'pasdetache';
        $date = $_POST['date'] ?? '';
        $importance = $_POST['import'] ?? '';
        if (empty($_POST['isPub'])) {
            $isPublic = 1;
        } else {
            $isPublic = 0;
        }
        $nomListe = $_POST['newList'] ?? '';

        //filter_var nettoyage
        Validation::validation_tache($tache, $date, $nomListe, $dVueEreur);
        if(!empty($dVueEreur)){
            require($rep.$vues["erreur"]);
        }else{
            $gateway = new TacheGateway($con);
            $gatewayList = new ListeGateway($con);


            $idListe = "visiteur" . $nomListe;
            if ($gatewayList->getList($idListe) == 1) {
                $gateway->update($idTache, $tache, $date, $importance, $isPublic, $idListe);
            } else {
                $gatewayList->insert($nomListe, "visiteur");
                $gateway->update($idTache, $tache, $date, $importance, $isPublic, $idListe);
            }


            $IdListes = $gatewayList->getIdListe();
            foreach ($IdListes as $idListe)
                if (($gateway->isEmpty($idListe[0])) == 0) {
                    $gatewayList->delete($idListe[0]);
                }
        }

        $this->afficherTache();
    }
}