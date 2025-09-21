<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet" type="text/css">
  <meta charset="utf-8">
  <title>desinscription seance</title>
</head>
<body>
  <div class="form-container">
    <?php
    include 'connexion.php';

    $result = mysqli_query($connect, 'SELECT ideleve,nom,prenom FROM eleves ORDER by nom');
    if (!$result) {
      echo "<br>Erreur: " . mysqli_error($connect);
      exit();
    }
    echo"
    <form method='POST' action='desinscription_seance.php'>
      <table>
        <thead>
          <tr>
            <th colspan='2'>
              <h2> Désinscription séances  </h2>
            </th>
          </tr>
        </thead>
        <tr>
          <td>
            <label for='eleve'>Élève</label>
          </td>
        </tr>
        <tr>
          <td>
            <select name='ideleve' id='eleve'>";
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
      echo "<option value='" . $row[0] . "'>" . $row[1] . " " . $row[2] . "</option>\n";
    }
    echo "
            </select>
          </td>
        </tr>
        <tr>
          <td>
            <input type='submit' value='Submit'>
          </td>
        </tr>
      </table>
    </form>";

    if (isset($_POST['ideleve']) && !empty($_POST['ideleve'])) {
      $ideleve = mysqli_real_escape_string($connect, $_POST['ideleve']);
      $result = mysqli_query($connect, "SELECT nom,prenom FROM eleves WHERE ideleve ='$ideleve'");
      $result2 = mysqli_query($connect, "SELECT inscription.idseance, seances.DateSeance, themes.nom FROM inscription JOIN seances ON inscription.idseance = seances.idseance JOIN themes ON themes.idtheme = seances.Idtheme WHERE inscription.ideleve ='$ideleve'  AND seances.DateSeance >= CURRENT_DATE"); //recup dans visualiser
      if (!$result || !$result2) {
        echo "<br>Erreur: " . mysqli_error($connect);
        exit();
      }

      $row = mysqli_fetch_array($result, MYSQLI_NUM);
      echo"
      <form method='POST' action='desinscrire_seance.php'>
        <table>
          <tr>
            <td> Elève: ". $row[0] ." ".$row[1]."</td>
          </tr>
          <tr>
            <td>";

      if (mysqli_num_rows($result2) > 0) {
        echo "<select name='idseance'>";
        while ($row = mysqli_fetch_array($result2, MYSQLI_NUM)) {
          echo "<option value='".$row[0]."'> Date:". $row[2] . " et thème:".$row[1]."</option>\n";
        }
        echo "</select></td></tr>
              <tr><td><input type='submit' value='Desinscrire'></td></tr>";
      } else {
        echo "Eleve inscrit à aucune séance</td></tr>";
      }

      echo "
        </table>
        <input type='number' name='ideleve' value='$ideleve' hidden>
      </form>";
    }
    mysqli_close($connect);
    ?>
  </div>
</body>
</html>
