<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
include 'connexion.php';
date_default_timezone_set('Europe/Paris');

// Vérification des entrées
if (!isset($_POST['nom']) || empty($_POST['nom'])) {
    echo "<h2>Le nom ne doit pas être vide</h2>";
    exit();
}

if (!isset($_POST['prenom']) || empty($_POST['prenom'])) {
    echo "<h2>Le prénom ne doit pas être vide</h2>";
    exit();
}

if (!isset($_POST['dateNaiss']) || empty($_POST['dateNaiss'])) {
    echo "<h2>La date de naissance ne doit pas être vide</h2>";
    exit();
}


// Échapper les caractères spéciaux
$nom = mysqli_real_escape_string($connect, $_POST['nom']);
if(mb_strlen($nom) > 30) {
    echo "<h2> le nom ne doit pas depasser 30 caractere </h2>";
    exit();
}
$prenom = mysqli_real_escape_string($connect, $_POST['prenom']);
if(mb_strlen($prenom) > 30) {
    echo "<h2> le prenom ne doit pas depasser 30 caractere </h2>";
    exit();
    }
$dateNaiss = mysqli_real_escape_string($connect, $_POST['dateNaiss']);
if( strtotime($dateNaiss) > strtotime("- 16 years")){
    echo "<div class='form-container'>
    <h2>Inscription à partir de 16 ans.</h2>
    </div>
    <a href='ajout_eleve.html'>
        <button type='button' class='btn-simple'>Retour</button>
    </a>
    <a href='accueil.html'>
        <button type='button' class='btn-simple'>Accueil</button>
    </a>";
    exit();
}


// Vérifie l'existence de l'élève
$query = "SELECT * FROM eleves WHERE nom='$nom' AND prenom='$prenom'";
$result = mysqli_query($connect, $query);

if (!$result) {
    echo "<br>Erreur: " . mysqli_error($connect);
    exit();
}

if (mysqli_num_rows($result) > 0) {
    // Si un élève existe déjà, demander confirmation
    echo "<h2>Au moins un élève avec le même nom et prénom existe déjà. Voulez-vous vraiment ajouter cet élève?</h2>";
    echo "
            <form method='post' action='ajouter_eleve.php'>
                <input type='hidden' name='nom' value='$nom'>
                <input type='hidden' name='prenom' value='$prenom'>
                <input type='hidden' name='dateNaiss' value='$dateNaiss'>
                <input class='btn-simple' type='submit' name='confirm' value='Oui'>
                <input class='btn-simple' type='submit' name='confirm' value='Non'> 
            </form>";
    exit();
} else {
    include 'ajouter_eleve.php';
}


?>
</body>
</html>
