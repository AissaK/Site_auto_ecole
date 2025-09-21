<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet" type="text/css">
  <title></title>
</head>
<body>
<?php
  include 'connexion.php';

  if (!isset($_POST['idtheme']) || empty($_POST['idtheme'])){
    echo" <h2> l'id du theme ne doit pas etre vide </h2>";
    exit();
  }

  $idtheme = mysqli_real_escape_string($connect, $_POST['idtheme']);

  $query = "UPDATE themes SET supprime = 1 WHERE idtheme ='$idtheme'";
  $result = mysqli_query($connect, $query);
  if (!$result) echo "<br>Erreur: ".mysqli_error($connect);
  else {
    echo "
    <br>
    <div class='button-container'>
      <h2>Le thème a été supprimé !</h2>
      <a href='suppression_theme.php'>
        <button type='button'>Retour</button>
      </a>
      <a href='accueil.html'>
        <button type='button'>Accueil</button>
      </a>
    </div>";
  }

  mysqli_close($connect);

?>
</body>
</html>