<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
<?php
include 'connexion.php';

$result = mysqli_query ($connect, 'SELECT * FROM eleves ORDER BY nom');

echo "<div class='form-container'>";
echo "<form method='POST' action='visualiser_calendrier_eleve.php'>";
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th colspan='2'><h2>Visualisation calendrier</h2></th>";
echo "</tr>";
echo "</thead>";
echo "<tr><td><label for='eleve'>Élève</label></td></tr>";
echo "<tr>";
echo "<td>";
echo "<select name='ideleve' id='eleve'>";

while ($row = mysqli_fetch_array($result)){
    echo "<option value='" . $row['ideleve'] . "'>" . $row['nom'] . " " . $row['prenom'] . "</option>";
}

echo "</select>";
echo "</td>";
echo "<td><input type='submit' value='Envoyer'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "</div>";

mysqli_close($connect);
?>
</body>
</html>
