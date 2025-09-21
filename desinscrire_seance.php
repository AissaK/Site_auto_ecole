<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <title>
            desinscrire seance
        </title>
        <LINK REL="stylesheet" HREF="style.css" type="text/css">
        <meta charset="UTF-8">
    </head>
    <body>
<?php
include 'connexion.php';

if (!isset($_POST['ideleve']) || empty($_POST['ideleve'])){
  echo" <h2> l'id de l' élève ne doit pas etre vide </h2>";
  exit();
}

$ideleve = mysqli_real_escape_string($connect, $_POST['ideleve']);

if (!isset($_POST['idseance']) || empty($_POST['idseance'])){
  echo" <h2> l'id de la seance ne doit pas etre vide </h2>";
  exit();
}

$idseance = mysqli_real_escape_string($connect, $_POST['idseance']);

$query = "DELETE FROM inscription WHERE idseance='$idseance' and ideleve ='$ideleve'";
$result = mysqli_query($connect, $query);

if (!$result) {
  echo "<br>Erreur: " . mysqli_error($connect);
  exit();
}

echo"
<br />
Elève desinscrit
";

echo "
<div class='button-container'>
  <a href='desinscription_seance.php'>
    <button type='button'>Retour</button>
  </a>
  <a href='accueil.html'>
    <button type='button'>Accueil</button>
  </a>
</div>";


mysqli_close($connect);
?>
</body>
</html>