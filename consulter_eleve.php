<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet" type="text/css">
  <meta charset="utf-8">
  <title>Consultation élève</title>
</head>
<body>
<?php
include 'connexion.php';

if (!isset($_POST['ideleve']) || empty($_POST['ideleve'])){
  echo"<h2>L'id élève ne doit pas être vide</h2>";
  exit();
}

$ideleve = mysqli_real_escape_string($connect, $_POST['ideleve']);

$result = mysqli_query($connect, "SELECT * FROM eleves WHERE ideleve ='$ideleve'");
if (!$result) {
  echo "<br>Erreur: " . mysqli_error($connect);
  exit();
}

echo "
<h2>Élève</h2>
<table class='consult-table'>
<thead>
<tr>
    <th>Ideleve</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Date Naissance</th>
    <th>Date Inscription</th>
</tr>
</thead>";
while ($row = mysqli_fetch_row($result)) {
  echo "<tr>";
  foreach ($row as $element) {
    echo "<td>" . htmlspecialchars($element) . "</td>";
  }
  echo "</tr>";
}
echo "</table>";

echo "
<div class='button-container'>
  <a href='consultation_eleve.php'>
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
