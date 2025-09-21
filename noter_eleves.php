<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet" type="text/css">
  <meta charset="utf-8">
</head>
<?php
include 'connexion.php';

if (!isset($_POST['idseance']) || empty($_POST['idseance'])){
  echo" <h2> l'id de la seance ne doit pas etre vide </h2>";
  exit();
}

$idseance = mysqli_real_escape_string($connect, $_POST['idseance']); 
//on recup l'idseance qu'on avait envoyer avec type hidden

$query = "SELECT * FROM inscription WHERE idseance ='$idseance'";
//recup info inscription donc idseance ideleve note.
$result = mysqli_query($connect,$query);
//echo "<br>$query<br>";
if (!$result) {
  echo "<br>Erreur: " . mysqli_error($connect);
  exit();
}
while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
  $note = mysqli_real_escape_string($connect, $_POST[$row[1]]);
   //row1 ideleve correspond au name de l'input number dans valider seance.
   //donc permet de recup la note.

  if ($note > 40 or $note < 0){
      echo "<br>Les notes doivent être comprises entre 0 et 40.";
      exit();
    }
  
  if (empty($note)){
    $note = 'NULL';
  } //si on a rien changé.
    
  $query = "UPDATE inscription SET note = $note WHERE ideleve =$row[1] AND idseance =$idseance";
  //met a jour les notes.
  //echo "<br>$query<br>";
  $maj = mysqli_query($connect,$query);
  if (!$maj) echo "<br>Erreur: ".mysqli_error($connect);

}
echo "<div class='form-container'>
<h2>Les notes ont été mises à jour !</h2>
</div>
<a href='validation_seance.php'>
    <button type='button' class='btn-simple'>Retour</button>
</a>
<a href='accueil.html'>
    <button type='button' class='btn-simple'>Accueil</button>
</a>";
mysqli_close($connect);
 ?>