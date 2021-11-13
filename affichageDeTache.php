<!DOCTYPE html>
<html lang="fr">
<p>
    <style>
        p{
            background-color: <?= $value->getCouleur(); ?>;
        }
    </style>
    <?php
        echo $value->__toString().'<br>';
    ?>
</p>

