<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <title>Ajouter Thème</title>
</head>
<body>
<?php
include 'connexion.php';

// Vérification des champs
if (!isset($_POST['nom']) || empty($_POST['nom'])){
    echo "<h2>Le nom ne doit pas être vide</h2>";
    exit();
}

$nom = mysqli_real_escape_string($connect, $_POST['nom']);

if(mb_strlen($nom) > 30) {
    echo "<h2>Le nom ne doit pas dépasser 30 caractères</h2>";
    exit();
}

if (!isset($_POST['descriptif']) || empty($_POST['descriptif'])){
    echo "<div class='form-container'>
    <h2>Le descriptif ne doit pas être vide</h2>
    </div>
    <a href='ajout_theme.html'>
        <button type='button' class='btn-simple'>Retour</button>
    </a>
    <a href='accueil.html'>
        <button type='button' class='btn-simple'>Accueil</button>
    </a>";
    exit();
}

$descriptif = mysqli_real_escape_string($connect, $_POST['descriptif']);
$query = "SELECT * FROM themes WHERE nom ='$nom' AND supprime = 1"; //check si le theme (avec le nom) a ete supprime
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) == 1) {
    $query = "UPDATE themes SET supprime = 0 WHERE nom ='$nom'";
    $result = mysqli_query($connect, $query);
    if (!$result){
        echo "<br>Erreur: ".mysqli_error($connect);
        exit();
    }
    echo "<div class='form-container'>
    <h2>Le thème ". $nom." "."qui a pour descriptif ". $descriptif. " a été reactivé avec succès.</h2>
    </div>
    <a href='ajout_theme.html'>
        <button type='button' class='btn-simple'>Retour</button>
    </a>
    <a href='accueil.html'>
        <button type='button' class='btn-simple'>Accueil</button>
    </a>";
} else {
    $query = "INSERT INTO themes VALUES (NULL, '$nom', '0', '$descriptif')";
    #echo "<br>$query<br>";
    $result = mysqli_query($connect, $query);
    if (!$result){
        echo "<br>Erreur:".mysqli_error($connect);
        exit();
    }
    echo "<div class='form-container'>
    <h2>Le thème ". $nom." "."qui a pour descriptif ". $descriptif. " a été ajouté avec succès.</h2>
    </div>
    <a href='ajout_theme.html'>
        <button type='button' class='btn-simple'>Retour</button>
    </a>
    <a href='accueil.html'>
        <button type='button' class='btn-simple'>Accueil</button>
    </a>";
}
mysqli_close($connect);
?>
</div>
</div>
</body>
</html>

