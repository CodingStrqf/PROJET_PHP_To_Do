<?php
require_once ('ListeTache.php');
class TacheGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    //méthodes qui font appel à la classe Connection

    public function insert(int $idTache, string $contenu, string $date, string $importance, int $isPublic, string $liste)
    {
        $query='INSERT INTO Tache VALUES(:idTache, :contenu, :date, :importance, :isPublic, :idListe)';
        $date = date_create_from_format("d/m/Y", $date)->format("Y/m/d");
        try {
            $this->con->executeQuery($query, array(
                ':idTache' => array($idTache, PDO::PARAM_INT),
                ':contenu' => array($contenu, PDO::PARAM_STR),
                ':date' => array($date, PDO::PARAM_STR),
                ':importance' => array($importance, PDO::PARAM_STR),
                ':isPublic' => array($isPublic, PDO::PARAM_INT),
                ':idListe' => array($liste, PDO::PARAM_STR)
            ));
        }catch(PDOException $e2){
            $dVueEreur[]=$e2->getMessage();
        }
        require('../vues/erreur.php');
    }

    public function update(int $idTache, string $contenu, string $date, string $importance, int $isPublic, string $idListe)
    {
        $query ='UPDATE Tache SET contenu=:contenu, date=:date, importance=:importance, isPublic=:isPublic, idListe=:idListe WHERE idTache=:id';
        $date = date_create_from_format("d/m/Y", $date)->format("Y/m/d");
        try {
            $this->con->executeQuery($query, array(
                ':id' => array($idTache, PDO::PARAM_INT),
                ':contenu' => array($contenu, PDO::PARAM_STR),
                ':date' => array($date, PDO::PARAM_STR),
                ':importance' => array($importance, PDO::PARAM_STR),
                ':isPublic' => array($isPublic, PDO::PARAM_INT),
                ':idListe' => array($idListe, PDO::PARAM_STR)
            ));
        }catch(PDOException $e){
            $dVueEreur[]=$e->getMessage();
        }
        require('../vues/erreur.php');
    }

    public function delete(int $idTache)
    {
        $query='DELETE FROM Tache WHERE idTache = :idTache';
        try {
            $this->con->executeQuery($query, array(
                ':idTache' => array($idTache, PDO::PARAM_INT)
            ));
        }catch(PDOException $e){
            $dVueEreur[]=$e->getMessage();
        }
        require('../vues/erreur.php');
    }


    public function RecupeIdListUtil(string $idUtilisateur)
    {
        $query = 'SELECT DISTINCT idListe,nom,idUtilisateur FROM ListeTache WHERE idUtilisateur = :idUtilisateur';

        try {
            $this->con->executeQuery($query, array(
                ':idUtilisateur' => array($idUtilisateur, PDO::PARAM_STR)
            ));
            $tab = $this->con->getResults();
            foreach ($tab as $row) {
                $toutesListeTache[] = new ListeTache($row['nom'],$row['idUtilisateur']);
            }
        } catch (PDOException $e) {
            $dVueEreur[] = $e->getMessage();
        }
        require('vues/erreur.php');
        return $tab;
    }

    public function RecupeTache(string $idListe)
    {
        $query = 'SELECT idTache,contenu,date,importance,isPublic FROM Tache WHERE idListe = :idListe';
        $tab = array();
        $toutesTaches = array();

        try {
            $this->con->executeQuery($query, array(
                ':idListe' => array($idListe, PDO::PARAM_STR)
            ));
            $tab = $this->con->getResults();

            foreach ($tab as $row) {
                $toutesTaches[] = new Tache($row['idTache'], $row['contenu'], $row['date'], $row['importance'], $row['isPublic'], $idListe);
            }
        } catch (PDOException $e) {
            $dVueEreur[] = $e->getMessage();
        }
        require('vues/erreur.php');
        return $toutesTaches;
    }

    public function RecupeTachePublic(string $idListe)
    {
        $query = 'SELECT idTache,contenu,date,importance FROM Tache WHERE idListe = :idListe AND isPublic = 1';
        $tab = array();
        $toutesTaches = array();

        try {
            $this->con->executeQuery($query, array(
                ':idListe' => array($idListe, PDO::PARAM_STR)
            ));
            $tab = $this->con->getResults();

            foreach ($tab as $row) {
                $toutesTaches[] = new Tache($row['idTache'], $row['contenu'], $row['date'], $row['importance'], 1, $idListe);
            }
        } catch (PDOException $e) {
            $dVueEreur[] = $e->getMessage();
        }
        require('vues/erreur.php');
        return $toutesTaches;
    }


    public function afficherTout(int $co, string $idCompte)
    {
        if($co == 1) {
            $tabTache=array();
            $tabList = $this->RecupeIdListUtil($idCompte);
            foreach ($tabList as $idList) {
                $tabTache[] = $this->RecupeTache($idList[0]);
            }
            return $tabTache;

        } else{
            $tabTache=array();
            $tabList = $this->RecupeIdListUtil($idCompte);
            foreach ($tabList as $idList) {
                $tabTache[] = $this->RecupeTachePublic($idList[0]);
            }
            return $tabTache;
        }
    }

    public function findByIdTache(int $idTache)
    {
        $query = 'SELECT idTache,contenu,date,importance,isPublic,idListe FROM Tache WHERE idTache=:idTache';
        $tab=array();
        try {
            $this->con->executeQuery($query, array(
                ':idTache' => array($idTache, PDO::PARAM_INT)
            ));
            $tab = $this->con->getResults();
        } catch (PDOException $e) {
            $dVueEreur[] = $e->getMessage();
        }
        require('../vues/erreur.php');
        return $tab;
    }

    public function isEmpty(string $idListe): int
    {
        $tab=array();
        $query='SELECT COUNT(*) FROM tache WHERE idListe = :idListe';
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

//    public function isEmptyPublic(string $idListe): int
//    {
//        $tab=array();
//        $query='SELECT COUNT(*) FROM tache WHERE idListe = :idListe AND isPublic = 1';
//        try {
//            $this->con->executeQuery($query, array(
//                ':idListe' => array($idListe, PDO::PARAM_STR),
//            ));
//            $tab = $this->con->getResults();
//        }catch(PDOException $e){
//            $dVueEreur[]=$e->getMessage();
//        }
//        require('vues/erreur.php');
//        return $tab[0][0];
//    }
}