<?php
class TacheGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    //méthodes qui font appel à la classe Connection
    public function insert(int $idTache, string $contenu, string $date, string $importance, int $isPublic): int
    {
        $query='INSERT INTO Tache VALUES(:idTache, :contenu, :date, :importance, :isPublic)';

        $this->con->executeQuery($query, array(
                                        ':idTache'=> array($idTache,PDO::PARAM_INT),
                                        ':contenu'=> array($contenu,PDO::PARAM_STR),
                                        ':date'=> array($date,PDO::PARAM_STR),
                                        ':importance'=> array($importance,PDO::PARAM_STR),
                                        ':isPublic'=> array($isPublic,PDO::PARAM_INT)
        ));
        return $this->con->lastInsertId();
    }
    public function update(int $idTache, string $contenu, string $date, string $importance, int $isPublic)
    {

    }
    public function delete(int $idTache)
    {

    }
}