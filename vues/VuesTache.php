<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" type="text/css" href="test.css">

<p class="taches" style= "background:<?php echo $value->getCouleur(); ?>">

    <?php
        echo $value->__toString().'<br>';
    ?>
    <form method="post">
        <input type="submit" value="Delete" >
        <input type="hidden" name="delete" value="<?php echo $value->getIdTache() ?>">
        <input type="hidden" name="action" value="supprimer">
    </form>
    <form method="post">
        <input type="submit" value="update" >
        <input type="hidden" name="update" value="<?php echo $value->getIdTache() ?>">
        <input type="hidden" name="action" value="modifier">
    </form>
</p>
</html>
