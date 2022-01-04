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
        global $rep,$vues;
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
        require($rep.$vues["erreur"]);
    }

    public function update(int $idTache, string $contenu, string $date, string $importance, int $isPublic, string $idListe)
    {
        global $rep,$vues;
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
        require($rep.$vues["erreur"]);
    }

    public function delete(int $idTache)
    {
        global $rep,$vues;
        $query='DELETE FROM Tache WHERE idTache = :idTache';
        try {
            $this->con->executeQuery($query, array(
                ':idTache' => array($idTache, PDO::PARAM_INT)
            ));
        }catch(PDOException $e){
            $dVueEreur[]=$e->getMessage();
        }
        require($rep.$vues["erreur"]);
    }


    public function RecupeIdListUtil(string $idUtilisateur)
    {
        global $rep,$vues;
        $query = 'SELECT DISTINCT idListe,nom,idUtilisateur FROM ListeTache WHERE idUtilisateur = :idUtilisateur OR idUtilisateur="visiteur"';

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
        require($rep.$vues["erreur"]);
        return $tab;
    }



    public function RecupeIdList()
    {
        global $rep,$vues;
        $query = 'SELECT DISTINCT idListe,nom,idUtilisateur FROM ListeTache';

        try {
            $this->con->executeQuery($query, array());
            $tab = $this->con->getResults();
            foreach ($tab as $row) {
                $toutesListeTache[] = new ListeTache($row['nom'],$row['idUtilisateur']);
            }
        } catch (PDOException $e) {
            $dVueEreur[] = $e->getMessage();
        }
        require($rep.$vues["erreur"]);
        return $tab;
    }

    public function RecupeTache(string $idListe)
    {
        global $rep,$vues;
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
        require($rep.$vues["erreur"]);
        return $toutesTaches;
    }

    public function RecupeTachePublic(string $idListe)
    {
        global $rep,$vues;
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
        require($rep.$vues["erreur"]);
        return $toutesTaches;
    }


    public function recupListUtil(string $idCompte)
    {
        $tabTache=array();
        if($idCompte == "visiteur") {

            $tabList = $this->RecupeIdList();
            foreach ($tabList as $idList) {
                $tache = $this->RecupeTachePublic($idList[0]);
                /*
                foreach ($tache as $tacheIndivi){
                    $tacheIndivi->setContenu($tacheIndivi->getContenu().' '.$idList[2] );
                }
                */
                $tabTache[] = $tache;
            }
            return $tabTache;
        } else{

            $tabList = $this->RecupeIdListUtil($idCompte);
            foreach ($tabList as $idList) {
                $tache = $this->RecupeTache($idList[0]);
                /*
                foreach ($tache as $tacheIndivi){
                    $tacheIndivi->setContenu($tacheIndivi->getContenu().' '.$idList[2] );
                }
                */
                $tabTache[] = $tache;
            }
            return $tabTache;
        }
    }


    public function findByIdTache(int $idTache)
    {
        global $rep,$vues;
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
        require($rep.$vues["erreur"]);
        return $tab;
    }

    public function isEmpty(string $idListe): int
    {
        global $rep,$vues;
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
        require($rep.$vues["erreur"]);
        return $tab[0][0];
    }

}