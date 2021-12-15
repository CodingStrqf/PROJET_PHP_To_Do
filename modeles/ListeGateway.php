<?php

class ListeGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    //méthodes qui font appel à la classe Connection

    public function insert(string $nom, string $idUtilisateur)
    {
        $idList=$nom.$idUtilisateur;
        $query='INSERT INTO listetache VALUES(:idList, :nom, :idUtilisateur)';
        try {
            $this->con->executeQuery($query, array(
                ':idList' => array($idList, PDO::PARAM_STR),
                ':nom' => array($nom, PDO::PARAM_STR),
                ':idUtilisateur' => array($idUtilisateur, PDO::PARAM_STR),
            ));
        }catch(PDOException $e){
            $dVueEreur[]=$e->getMessage();
        }
        require('../vues/erreur.php');
    }


    public function delete(string $idList)
    {
        $query='DELETE FROM listetache WHERE idList = :idList';
        try {
            $this->con->executeQuery($query, array(
                ':idList' => array($idList, PDO::PARAM_STR)
            ));
        }catch(PDOException $e){
            $dVueEreur[]=$e->getMessage();
        }
        require('../vues/erreur.php');
    }
}