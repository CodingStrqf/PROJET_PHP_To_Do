<?php
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
        require($rep.$vues['erreur']);
    }

    public function update(int $idTache, string $contenu, string $date, string $importance, int $isPublic)
    {
        $query ='UPDATE Tache SET contenu=:contenu, date=:date, importance=:importance, isPublic=:isPublic WHERE idTache=:id';
        $date = date_create_from_format("d/m/Y", $date)->format("Y/m/d");
        try {
            $this->con->executeQuery($query, array(
                ':id' => array($idTache, PDO::PARAM_INT),
                ':contenu' => array($contenu, PDO::PARAM_STR),
                ':date' => array($date, PDO::PARAM_STR),
                ':importance' => array($importance, PDO::PARAM_STR),
                ':isPublic' => array($isPublic, PDO::PARAM_INT)
            ));
        }catch(PDOException $e){
            $dVueEreur[]=$e->getMessage();
        }
        require($rep.$vues['erreur']);
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
        require($rep.$vues['erreur']);
    }


    public function RecupeIdListUtil(string $idUtilisateur)
    {
        $query = 'SELECT idList FROM ListeTache WHERE idUtilisateur = :idUtilisateur';

        try {
            $this->con->executeQuery($query, array(
                ':idUtilisateur' => array($idUtilisateur, PDO::PARAM_STR)
            ));
            $tab = $this->con->getResults();
        } catch (PDOException $e) {
            $dVueEreur[] = $e->getMessage();
        }
        require('vues/erreur.php');
        return $tab;
    }

    public function RecupeTache(string $idList)
    {
        $query = 'SELECT idTache,contenu,date,importance,isPublic FROM Tache WHERE idListe = :idListe';

        try {
            $this->con->executeQuery($query, array(
                ':idList' => array($idList, PDO::PARAM_STR)
            ));
            $tab = $this->con->getResults();
        } catch (PDOException $e) {
            $dVueEreur[] = $e->getMessage();
        }
        require($rep.$vues['erreur']);
        return $tab;
    }


    public function afficherTout(int $co, string $idCompte)
    {
        if($co == 1) {
            $tabList = $this->RecupeIdListUtil($idCompte);

            $tabTache = array();
            foreach ($tabList as $idList){
                $tabTache = $this->RecupeTache($idList);
            }
            return $tabTache;
        }else{
            $query = 'SELECT idTache,contenu,date,importance,isPublic FROM Tache WHERE isPublic = 1 ';

            $toutesTaches = array();
            try {
                $this->con->executeQuery($query, array());
                $resultats = $this->con->getResults();
                foreach ($resultats as $row) {
                    $toutesTaches[] = new Tache($row['idTache'], $row['contenu'], $row['date'], $row['importance'], $row['isPublic']);
                }
            } catch (PDOException $e) {
                $dVueEreur[] = $e->getMessage();
            }
            require($rep.$vues['erreur']);
            return $toutesTaches;
        }
    }

    public function findByIdTache(int $idTache)
    {
        $query = 'SELECT idTache,contenu,date,importance,isPublic FROM Tache WHERE idTache=:idTache';

        try {
            $this->con->executeQuery($query, array(
                ':idTache' => array($idTache, PDO::PARAM_INT)
            ));
            $tab = $this->con->getResults();
        } catch (PDOException $e) {
            $dVueEreur[] = $e->getMessage();
        }
        require($rep.$vues['erreur']);
        return $tab;
    }
}