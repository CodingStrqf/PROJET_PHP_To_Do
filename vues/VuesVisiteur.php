<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="test.css">
</head>

<form method="post">
    <input type="submit" value="Connection">
    <input type="hidden" name="action" value="connection">
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


    <input type="submit" value="Accept">
    <input type="hidden" name="action" value="ajouter">
    </p>
</form>
</span>
</body>
</html>
