<!DOCTYPE html>
<html lang="fr">

<form  method="post">
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

    <input type="submit" value="Accept">
    <input type="hidden" name="action" value="confirmerTache">
    <input type="hidden" name="idTache" value="<?php echo $IdTache ?>">
    <input type="hidden" name="idListe" value="<?php echo $idListe ?>">
    </p>
</form>
