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
$result = mysqli_query($connect, 'SELECT * FROM eleves ORDER BY nom');
echo "
<div class='form-container'>
  <form method='POST' action='consulter_eleve.php'>
    <table>
      <thead>
        <tr>
          <th colspan='2'>
            <h2>Consultation élève</h2>
          </th>
        </tr>
      </thead>
      <tr>
        <td><label for='eleve'><b>Élève</b></label></td>
      </tr>
      <tr>
        <td>
          <select name='ideleve' id='eleve'>\n";
while ($row = mysqli_fetch_array($result)) {
  echo "<option value='" . $row['ideleve'] . "'>" . $row['nom'] . " " . $row['prenom'] . "</option>\n";
}
echo "
          </select>
        </td>
        <td><input type='submit' value='Envoyer'></td>
      </tr>
    </table>
  </form>
</div>";
mysqli_close($connect);
?>
</body>
</html>
