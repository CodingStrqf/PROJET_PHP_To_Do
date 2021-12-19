<?php
require_once("modeles/ConnectionGateway.php");
require_once("vues/erreur.php");
require_once("modeles/Connection.php");
require_once("UserControler.php");
require_once("AdminControler.php");

class FrontController
{
    public function __construct()
    {
        require("config/config.php");

        try{
            $con = new Connection($dns, $user, $mdp);
        }catch(PDOException $e1){
            $dVueEreur[]=$e1->getMessage();
        }

        $gatewayConnection = new ConnectionGateway($con);
        session_start();

        require("vues/AffichageConnection.php");


        if(isset($_POST['envoyer'])) {                                                          // Test apres avoir clique dans AffichageConnection
            $id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
            $mdp = filter_var($_POST['mdp'], FILTER_SANITIZE_STRING);

            $exist = $gatewayConnection->rechercheUtil($id,$mdp);

            if($exist)
                $c = new UserControler($id);                                              // connecte
            else
                echo 'problème de login ou de mdp';
        }

        if(isset($_POST['pasCo']))
            $c = new UserControler(null);                                               // pas connecte
    }
}