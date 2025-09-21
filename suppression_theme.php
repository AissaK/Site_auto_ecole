<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet" type="text/css">
  <meta charset="utf-8">
  <title>Suppression thème</title>
</head>
<body>
  <div class="form-container">
    <h2> Suppression thème </h2>
    <form action="supprimer_theme.php" method="post">
      <table>
        <?php
        include 'connexion.php';
        $result = mysqli_query($connect,"SELECT * FROM themes where supprime=0 ");
        if (!$result) {
          echo "<br>Erreur: " . mysqli_error($connect);
          exit();
        }
        echo "
        <tr> 
          <td> 
            <label for='theme'> Thème </label> 
          </td> 
        </tr>
        <tr>
          <td align='center'> 
            <select name='idtheme' id='theme'>";
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
          echo "<option value='$row[0]'> $row[1] </option>\n";
        }
        echo "
            </select>
          </td>
          <td>
            <input type='submit' value='Supprimer'>
          </td>
        </tr>
      </table>
    </form>
  </div>";
  mysqli_close($connect);
  ?>
</body>
</html>
