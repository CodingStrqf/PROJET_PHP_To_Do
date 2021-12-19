<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="test.css">
</head>

<?php echo 'vous etes connecte '.$_SESSION['login']; ?>
<form method="post">
    <input type="submit" value="Deconnection">
    <input type="hidden" name="action" value="deconnection">
</form>

<h1> To Do List</h1>
<body>
<span  class="corp">

<form method="post">
<p>
    <h2> Ajouter tache </h2>

    <label for="tache" >
        Tache : <input type="text" name="tache"> <br>
    </label>

    <label for="date" >
        Date : <input type="text" name="date"> <br>
    </label>

    <label for="import">
        Importance : <select name="import">
            <option value="#FF0000">Important</option>
            <option value="#FFA600">Moyennement important</option>
            <option value="#00FF94">Pas important</option>
        </select>
    </label>


    <label for="newList" >
        Liste : <input type="text" name="newList"> <br>
    </label>

     <label for="isPub">
                Rendre privé : <input type="checkbox" name="isPub" > <br><br>
     </label>


    <input type="submit" value="Accept">
    <input type="hidden" name="action" value="ajouter">
    </p>
</form>

</span>
</body>
</html>
