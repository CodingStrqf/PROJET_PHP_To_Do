<?php
require_once("modeles/ConnectionGateway.php");
require_once("vues/erreur.php");
require_once("modeles/Connection.php");

class FrontController
{
    private ConnectionGateway $gatewayConnection;

    public function __construct()
    {
        require("config/config.php");
        global $con;
        try{
            $con = new Connection($dns, $user, $mdp);
        }catch(PDOException $e1){
            $dVueEreur[]=$e1->getMessage();
        }

        $gatewayConnection = new ConnectionGateway($con);
        session_start();
        $_SESSION['login'] = null;

        require("vues/AffichageConnection.php");

        if($_SESSION['login'] != null){
            require("vues/AffichageDeb.php");
        }
    }


    public function connection($login, $mdp){
        $login = filter_var($login, FILTER_SANITIZE_STRING);
        $mdp = filter_var($mdp, FILTER_SANITIZE_STRING);

        if($gatewayConnection->rechercheUtil($id,$mdp)){

        }
    }
}