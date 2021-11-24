<?php
class TacheGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    //méthodes qui font appel à la classe Connection
    public function insert(int $id, string $contenu, string $date, string $importance, int $estPublic): int
    {
        $query='INSERT INTO Tache VALUES(:id, :contenu, :date, :importance, :estPublic)';

        $this->con->executeQuery($query, array(
                                        ':id'=> array($id,PDO::PARAM_INT),
                                        ':contenu'=> array($contenu,PDO::PARAM_STR),
                                        ':date'=> array($date,PDO::PARAM_STR),
                                        ':importance'=> array($importance,PDO::PARAM_STR),
                                        ':estPublic'=> array($estPublic,PDO::PARAM_INT)
        ));
        return $this->con->lastInsertId();
    }
    public function update(int $id, string $contenu, string $date, string $importance, int $estPublic)
    {

    }
    public function delete(int $id)
    {

    }
}