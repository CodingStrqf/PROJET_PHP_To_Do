<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" type="text/css" href="test.css">

<p class="taches" style= "background:<?php echo $value->getCouleur(); ?>">

    <?php
        echo $value->__toString().'<br>';
    ?>
    <form action="controller/delete.php" method="post">
        <input type="submit" value="delete" >
        <input type="hidden" name="delete" value="<?php echo $value->getIdTache() ?>">
        <input type="hidden" name="estConnecte" value="<?php echo $co ?>">
    </form>
    <form action="controller/updateTache1.php" method="post">
        <input type="submit" value="update" >
        <input type="hidden" name="update" value="<?php echo $value->getIdTache() ?>">
        <input type="hidden" name="estConnecte" value="<?php echo $co ?>">
    </form>
</p>

