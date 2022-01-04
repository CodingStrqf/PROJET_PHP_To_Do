<?php

class ConnectionGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function rechercheUtil(string $id, string $mdp):int{
        global $rep, $vues;
        try {
            $query = 'SELECT id,mdp FROM utilisateur WHERE id = :id AND mdp = :mdp';
            $resultat = $this->con->executeQuery($query, array(
                ':id' => array($id, PDO::PARAM_STR),
                ':mdp' => array($mdp, PDO::PARAM_STR)
            ));
        }catch (PDOException $e) {
            $dVueEreur[] = $e->getMessage();
        }
        require($rep.$vues["erreur"]);
        return count($this->con->getResults());
    }
}