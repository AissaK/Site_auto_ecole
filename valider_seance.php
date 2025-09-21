<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet">
  <meta charset="utf-8">
  <title>Valider séance</title>
</head>

    <?php
    include 'connexion.php';
    if (!isset($_POST['idseance']) || empty($_POST['idseance'])){
      echo" <h2> l'id de la seance ne doit pas etre vide </h2>";
      exit();
    }
    
    $idseance = mysqli_real_escape_string($connect, $_POST['idseance']);

    $result = mysqli_query($connect,"SELECT idseance,DateSeance, themes.nom FROM seances JOIN themes ON seances.Idtheme = themes.idtheme AND idseance = '$idseance' ");
    $result2 = mysqli_query($connect,"SELECT eleves.nom, eleves.prenom, inscription.ideleve, inscription.idseance, inscription.note FROM inscription  JOIN eleves  ON  eleves.ideleve = inscription.ideleve AND inscription.idseance = '$idseance'");
    // result pour recuperer données seances result2 pour recuperer données eleves et son inscription
    if (!$result || !$result2) echo "<br>Erreur: ".mysqli_error($connect);



    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    echo"
    <br>
    <form action='noter_eleves.php' method='post'>
    <table>
    <thead>
    <tr><th colspan='3' >Elèves inscrits à la séance du $row[1] et qui a pour thème $row[2] </th></tr>
    <tr><th>Nom</th><th>Prénom</th><th>Nombre de fautes</th></tr>
    </thead>
    <tr>"; // row2 = ideleve row4 = note row1 = prenom row0 = nom
    while ($row=mysqli_fetch_array($result2, MYSQLI_NUM)) {
      echo"
      <td align='center'>$row[0]</td> 
      <td align='center'>$row[1]</td>
      <td align='center'><input type='number' min=0 max=40 name='$row[2]' placeholder='$row[4]'></td> 
      </tr>";
  }
    echo"
    </table><br>
    <table>
    <tr><td><input type='number' name='idseance' value='$idseance' hidden ></td><td></td></tr>
    <tr>
      <td>
        <a href='validation_seance.php'>
          <button class='btn-simple' type='button'>Retour</button>
        </a>
      </td>
      <td>
        <input type='submit' value='Mettre à jour' style='
          background-color: #4CAF50;
          color: white;
          border: none;
          padding: 10px 20px;
          cursor: pointer;
          border-radius: 4px;'>
      </td>
    </tr>
    </table>
    </form>";

    mysqli_close($connect);
    ?>


</body>
</html>