<?php

class FrontController
{
    public function __construct()
    {
        global $rep, $vues, $con;
        try{
            $con = new Connection($dns, $user, $mdp);
        }catch(PDOException $e1){
            $dVueEreur[]=$e1->getMessage();
        }
        require("../vues/erreur.php");

        $gatewayConnection = new ConnectionGateway($con);
        session_start();

        require("vues/AffichageConnection.php");


        if(isset($_POST['envoyer'])) {                                                          // Test apres avoir clique dans AffichageConnection
            $id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
            $mdp = filter_var($_POST['mdp'], FILTER_SANITIZE_STRING);

            $exist = $gatewayConnection->rechercheUtil($id,$mdp);

            if($exist)
                $c = new UserController($id);                                              // connecte
            else
                echo 'problème de login ou de mdp';
        }

        if(isset($_POST['pasCo']))
            $c = new GestController();                                               // pas connecte
    }
}