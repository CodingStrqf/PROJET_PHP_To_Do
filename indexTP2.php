<?php

require("Connection.php");
require("TacheGateway.php");

$dsn = 'mysql:host=localhost;dbname=tp2';
$user = 'addenonfou';
$password = 'Adrien.202';
$ad = new PDO($dsn, $user, $password);

$id = 0;
$contenu = '2eme tache';
$date='2021-11-17';
$importance='rouge';
$estPublic=1;


$b = new TacheGateway(new Connection($dsn, $user, $password));
// Insert a new record
$id = $b->insert($id,$contenu,$date,$importance,$estPublic);
// Update it
//$b->update($id, ’titre2’) ou $b->update($book)
// Delete it
//$b->delete($id);


/*
try {
    $con = new Connection($dsn, $user, $password);
}
catch(PDOException $e1){
    echo $e1->getMessage();
}

$id = 1;
$contenu = 'test';

$query ='UPDATE Tache SET contenu=:contenu WHERE idTache=:id';

try {
    $con->executeQuery($query, array(
        ':id' => array($id, PDO::PARAM_INT),
        ':contenu' => array($contenu, PDO::PARAM_STR)
        //':date'=> array($date,PDO::PARAM_STR),
        //':importance'=> array($importance,PDO::PARAM_STR),
        //':estPublic'=> array($estPublic,PDO::PARAM_INT)
    ));
}catch(PDOException $e2){
    echo $e2->getMessage();
}

$id = 2;
$contenu = '2eme tache';
$date='2021-11-17';
$importance='rouge';
$estPublic=1;

$query ='INSERT INTO Tache VALUES(:id,:contenu,:date,:importance,:estPublic)';

try {
    $con->executeQuery($query, array(
        ':id' => array($id, PDO::PARAM_INT),
        ':contenu' => array($contenu, PDO::PARAM_STR),
        ':date'=> array($date,PDO::PARAM_STR),
        ':importance'=> array($importance,PDO::PARAM_STR),
        ':estPublic'=> array($estPublic,PDO::PARAM_INT)
    ));
}catch(PDOException $e2){
    echo $e2->getMessage();
}
//$results=$con->getResults();
*/

?>