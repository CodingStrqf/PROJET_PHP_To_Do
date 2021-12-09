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
        require("vues/erreur.php");
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
        }catch(PDOException $e3){
            $dVueEreur[]=$e3->getMessage();
        }
        require("vues/erreur.php");
    }

    public function delete(int $idTache)
    {
        $query='DELETE FROM Tache WHERE idTache = :idTache';
        try {
            $this->con->executeQuery($query, array(
                ':idTache' => array($idTache, PDO::PARAM_INT)
            ));
        }catch(PDOException $e4){
            $dVueEreur[]=$e4->getMessage();
        }
        require("vues/erreur.php");
    }

    public function afficherTout(int $co, string $idCompte)
    {
        if($co == 1) {
            $queryListe = 'SELECT idList FROM listetache WHERE idUtilisateur = :idCompte'
            $tabListe = array();
            try {
                $this->con->executeQuery($queryListe,array());
                $resultatsListe = $this->con->getResults();
                foreach ($resultatsListe as $rowListe){
                    $tabTache = array();

                    $tabListe =
                }

            }catch (PDOException $e5) {
                $dVueEreur[] = $e5->getMessage();
            }




            $query = 'SELECT idTache,contenu,date,importance,isPublic,idListe FROM Tache';

            $toutesTaches = array();
            try {
                $this->con->executeQuery($query, array());
                $resultats = $this->con->getResults();
                foreach ($resultats as $row) {
                    $toutesTaches[] = new Tache($row['idTache'], $row['contenu'], $row['date'], $row['importance'], $row['isPublic'], $row['idListe']);
                }
            } catch (PDOException $e5) {
                $dVueEreur[] = $e5->getMessage();
            }
            require("vues/erreur.php");
            return $toutesTaches;
        }else{
            $query = 'SELECT idTache,contenu,date,importance,isPublic FROM Tache WHERE isPublic = 1 ';

            $toutesTaches = array();
            try {
                $this->con->executeQuery($query, array());
                $resultats = $this->con->getResults();
                foreach ($resultats as $row) {
                    $toutesTaches[] = new Tache($row['idTache'], $row['contenu'], $row['date'], $row['importance'], $row['isPublic']);
                }
            } catch (PDOException $e5) {
                $dVueEreur[] = $e5->getMessage();
            }
            require("vues/erreur.php");
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
        require("vues/erreur.php");
        return $tab;
    }

}