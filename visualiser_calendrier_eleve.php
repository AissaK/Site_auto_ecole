<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
<?php
include 'connexion.php';

if (!isset($_POST['ideleve']) || empty($_POST['ideleve'])){
    echo" <h2> l'id élève ne doit pas être vide </h2>";
    exit();
}

$ideleve = mysqli_real_escape_string($connect, $_POST['ideleve']);

$result = mysqli_query ($connect, "SELECT inscription.idseance, seances.DateSeance, themes.nom FROM inscription JOIN seances ON inscription.idseance = seances.idseance JOIN themes ON themes.idtheme = seances.Idtheme WHERE inscription.ideleve = '$ideleve' AND seances.DateSeance >= CURRENT_DATE ORDER by seances.DateSeance");

$eleve = mysqli_query($connect, "SELECT nom,prenom FROM eleves WHERE ideleve = '$ideleve'");
if (!$result || !$eleve) {               
    echo "Error:". mysqli_error($connect);
    exit();
}
$row = mysqli_fetch_row($eleve);
echo "<div class='consult-table'>";
echo "<h2>Seances à venir pour $row[0] $row[1] </h2>";
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>Idseance</th>";
echo "<th>Date seance</th>";
echo "<th>Thème seance</th>";
echo "</tr>";
echo "</thead>";
while ($row = mysqli_fetch_row($result)) {
    echo "<tr>";
    foreach ($row as $element) {
        echo "<td align='center'>".$element."</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo "</div>";
echo "
<div class='button-container'>
  <a href='visualisation_calendrier.php'>
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
