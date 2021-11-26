<?php
require_once("../modeles/Tache.php");
require("../Connection.php");
require("../TacheGateway.php");
require("../config/config.php");

$idTache= $_POST['delete'];


//connection
try {
    $con = new Connection($dns, $user, $mdp);
} catch(PDOException $e6){
    $dVueEreur[]=$e6->getMessage();
}
require("../vues/erreur.php");

$gateway = new TacheGateway($con);
//insertion
$gateway->delete($idTache);

?>
<meta http-equiv="refresh" content="1; url=<?php echo $_SERVER["HTTP_REFERER"]  ; ?>" />