<!DOCTYPE html>
<html lang="fr">
<?php
require_once('../modeles/Tache.php');



$idTache= $_POST['update'];
$connect=$_POST['estConnecte'];


// ** Base de donnée ** //

require("../modeles/Connection.php");
require("../modeles/TacheGateway.php");
require("../modeles/ListeGateway.php");
require("../config/config.php");
try{
    $con = new Connection($dns, $user, $mdp);
}catch(PDOException $e1){
    $dVueEreur[]=$e1->getMessage();
}
require("../vues/erreur.php");


$gateway = new TacheGateway($con);



//insertion
$gatewayList = new ListeGateway($con);
$tab=$gateway->findByIdTache($idTache);

foreach ($tab as $row) {
    $tache = new Tache($row['idTache'], $row['contenu'], $row['date'], $row['importance'], $row['isPublic'], $row['idListe']);
}

$date = date_create_from_format("Y-m-d", $tache->getDate())->format("d/m/Y");

$IdTache=$tache->getIdTache();
$contenu=$tache->getContenu();
$importance=$tache->getCouleur();
$isPublic=$tache->getIsPublic();
$idListe=$tache->getIdListe();

$nom=$gatewayList->findByIdListe($idListe);

?>
<form action="updateTache2.php" method="post">
    <p>
    <h2> Modifier une tache </h2>

    <label for="tache" >
        Tache : <input type="text" name="tache" value="<?php echo $contenu ?>"> <br><br>
    </label>

    <label for="date" >
        Date : <input type="text" name="date" value="<?php echo $date ?>"> <br><br>
    </label>

    <label for="import">
        Importance : <select name="import">
            <option value="#FF0000" <?php echo ($importance == '#FF0000') ? 'selected' : '' ?>>Important</option>
            <option value="#FFA600" <?php echo ($importance == '#FFA600') ? 'selected' : '' ?>>Moyennement important</option>
            <option value="#00FF94" <?php echo ($importance == '#00FF94') ? 'selected' : '' ?>>Pas important</option>
        </select>
        <br><br>
    </label>

    <label for="newList" >
        Liste : <input type="text" name="newList" value="<?php echo $nom[0] ?>"> <br>
    </label>

    <?php

    if ($connect == '0'){
        echo '
            <label for="isPub">
                Rendre privé : vous n\'etes pas connecte, vous ne pouvez pas faire ca <br><br>
                <input type="hidden" name="estConnecte" value="0" >
            </label>';
    }else{?>
            <label for="isPub">
                Rendre privé : <input type="checkbox" name="isPub" <?php echo ($isPublic == 0) ? 'checked="checked"' : '' ?> > <br><br>
            </label>
    <?php
    }
    ?>

    <button>Accept</button>
    <input type="hidden" name="idTache" value="<?php echo $IdTache ?>">
    <input type="hidden" name="estConnecte" value="<?php echo $connect ?>">
    </p>
</form>


