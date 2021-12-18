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
        $idListe=$idUtilisateur.$nom;
        $query='INSERT INTO listetache VALUES(:idListe, :nom, :idUtilisateur)';
        try {
            $this->con->executeQuery($query, array(
                ':idListe' => array($idListe, PDO::PARAM_STR),
                ':nom' => array($nom, PDO::PARAM_STR),
                ':idUtilisateur' => array($idUtilisateur, PDO::PARAM_STR)
            ));
        }catch(PDOException $e){
            $dVueEreur[]=$e->getMessage();
        }
        require('../vues/erreur.php');
    }


    public function delete(string $idListe)
    {
        $query='DELETE FROM listetache WHERE idListe = :idListe';
        try {
            $this->con->executeQuery($query, array(
                ':idListe' => array($idListe, PDO::PARAM_STR)
            ));
        }catch(PDOException $e){
            $dVueEreur[]=$e->getMessage();
        }
        require('../vues/erreur.php');
    }

    public function getList(string $idListe): int
    {
        $tab=array();
        $query='SELECT COUNT(*) FROM listetache WHERE idListe = :idListe';
        try {
            $this->con->executeQuery($query, array(
                ':idListe' => array($idListe, PDO::PARAM_STR),
            ));
            $tab = $this->con->getResults();
        }catch(PDOException $e){
            $dVueEreur[]=$e->getMessage();
        }
        require('../vues/erreur.php');
        return $tab[0][0];
    }


    public function findByIdListe(string $idListe)
    {
        $query = 'SELECT nom FROM listetache WHERE idListe=:idListe';
        $tab=array();
        $this->con->executeQuery($query, array(
            ':idListe' => array($idListe, PDO::PARAM_STR)
        ));
        $tab = $this->con->getResults();
        return $tab[0];
    }

    public function getIdListe()
    {
        $query = 'SELECT idListe FROM listetache ';
        $tab=array();
        try {
            $this->con->executeQuery($query, array());
            $tab = $this->con->getResults();
        } catch (PDOException $e) {
            $dVueEreur[] = $e->getMessage();
        }
        require('../vues/erreur.php');
        return $tab;
    }
}