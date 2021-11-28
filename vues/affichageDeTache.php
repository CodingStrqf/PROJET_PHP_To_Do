<!DOCTYPE html>
<html lang="fr">
<p style= "background:<?php echo $value->getCouleur(); ?>">

    <?php
        echo $value->__toString().'<br>';
    ?>
    <form action="controller/delete.php" method="post">
        <input type="submit" value="delete" >
        <input type="hidden" name="delete" value=<?php echo $value->getIdTache() ?>>
    </form>
    <form action="controller/delete.php" method="post">
        <input type="submit" value="update" >
        <input type="hidden" name="update" value="<?php echo $value->getIdTache() ?>">
    </form>
</p>

