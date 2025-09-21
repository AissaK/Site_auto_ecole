<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet" type="text/css">
  <meta charset="utf-8">
  <title>Liste séance</title>
</head>
<body>
  <div class="form-container">
    <h2> Sélection séance </h2>
    <form action="valider_seance.php" method="post">
      <table border="1">
        <?php
        include 'connexion.php';
        $result = mysqli_query($connect, "SELECT idseance, DateSeance, themes.nom FROM seances JOIN themes ON seances.Idtheme = themes.idtheme AND DateSeance <= CURRENT_DATE");
        if (!$result) { // la requete recupere les infos des seances passées
          echo "<br>Erreur: " . mysqli_error($connect);
          exit();
        }
        echo "<h2><label for='seance'>Séance</label></h2>";
        echo "<select name='idseance' id='seance'>\n";
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
          echo "<option value='$row[0]'>Thème: $row[2] et date: $row[1]</option>\n";
        } // la value est idseance.
        echo "</select></td></tr>";
        echo "<input type='submit' value='Envoyer'>";
        echo "</form>";
        mysqli_close($connect);
        ?>
    </form>
  </div>
</body>
</html>
