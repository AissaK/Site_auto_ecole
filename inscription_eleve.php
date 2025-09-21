<?php
include 'connexion.php';
$result1 = mysqli_query($connect, 'SELECT ideleve, nom, prenom FROM eleves');
//recupere info eleve
$result2 = mysqli_query($connect, 'SELECT idseance,themes.nom,DateSeance,EffMax FROM seances JOIN themes ON seances.Idtheme = themes.idtheme AND DateSeance >= CURRENT_DATE ORDER BY DateSeance');
//recupere info seances superieur ou egal a date actuelle. 
if (!$result1 || !$result2) {
  echo "<br>Erreur: " . mysqli_error($connect);
  exit();
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet" type="text/css">
  <meta charset="utf-8">
</head>
<body>

<div class="form-container"> 
  <table>
    <tr>
      <th>
        <h2> Inscription élève </h2>
      </th>
    </tr>
    <tr><td>Élève</td></tr>
    <tr><td>
      <form action='inscrire_eleve.php' method='POST'>
        <select name='ideleve'>\n
          <?php
          while ($row = mysqli_fetch_array($result1, MYSQLI_NUM)) {
            $ideleve = htmlspecialchars($row[0],ENT_QUOTES, 'UTF-8');
            $nom = htmlspecialchars($row[1],ENT_QUOTES, 'UTF-8');
            $prenom = htmlspecialchars($row[2],ENT_QUOTES, 'UTF-8');
            echo "<option value='$ideleve'> Eleve: $nom $prenom</option>\n";
          }
          ?>
        </select>
      </td></tr>
      <tr><td>Séance:</td></tr>
      <tr><td>
        <select name='idseance' required>
          <?php
          while ($row = mysqli_fetch_array($result2, MYSQLI_NUM)) {
            $idseance = htmlspecialchars($row[0],ENT_QUOTES, 'UTF-8');
            $themes_nom = htmlspecialchars($row[1],ENT_QUOTES, 'UTF-8');
            $DateSeance = htmlspecialchars($row[2],ENT_QUOTES, 'UTF-8');
            $EffMax = htmlspecialchars($row[3],ENT_QUOTES, 'UTF-8');
            $result3 = mysqli_query($connect, "SELECT COUNT(idseance) FROM inscription WHERE idseance ='$idseance'");
            //calcule le nbr d inscrits.
            if (!$result3) {
              echo "<br>Erreur: " . mysqli_error($connect);
              exit();
            }
            $nbr_inscrits =  mysqli_fetch_array($result3, MYSQLI_NUM);
            $inscriptions_restantes = $EffMax - $nbr_inscrits[0];
            // calcule les places restantes en faisant la difference avec l effectif maximum et le nbr d'inscrits
            if ( $inscriptions_restantes > 0) {
              echo "<option value='$idseance'>$themes_nom $DateSeance , il y a $inscriptions_restantes inscriptions possibles restantes ) </option>\n";
            } else {
              echo "<option value='$idseance' disabled > $themes_nom $DateSeance, la séance est pleine</option>\n";
            }
          }
          ?>
        </select>
      </td></tr>
      <tr><td>
        <input type='submit' value='Envoyer'>
      </td></tr>
      </form>
  </table>
</div> 

</body>
</html>

<?php
mysqli_close($connect);
?>
