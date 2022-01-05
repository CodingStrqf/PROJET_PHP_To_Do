<?php

class FrontController
{
    public function __construct()
    {
        $dVueEreur=[];
        global $rep, $vues, $con;

        try {
            $con = new Connection(dns, user, mdp);
        } catch (PDOException $e1) {
            $dVueEreur[] = $e1->getMessage();
        }
        require($rep . $vues["erreur"]);

        $gatewayConnection = new ConnectionGateway($con);
        session_start();



        if (isset($_POST['envoyer'])) {                             // Test apres avoir clique dans AffichageConnection

            $id=$_POST['id'];
            $mdp=$_POST['mdp'];
            Validation::validation_utilisateur($id, $mdp, $dVueEreur);
            if(!empty($dVueEreur)){
                require($rep . $vues["erreur"]);
                require($rep . $vues["connection"]);
            }else{
                $exist = $gatewayConnection->rechercheUtil($id, $mdp);

                if ($exist) {
                    $c = new UserController($id);                                              // connecte
                } else  {
                    echo 'Votre login ou votre mot de passe est erroné';
                    echo'<form method="post">
                        <input type="submit" value="Re essayer la connection">
                        <input type="hidden" name="action" value="connection">
                        </form>
                        ';
                }
            }


        } else {
            if (!empty($_SESSION['login'])) {

                $c = new UserController($_SESSION['login']);
            } else {
                $c = new VisiteurController();
            }
        }
    }
}