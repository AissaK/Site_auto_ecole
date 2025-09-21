<?php
  include 'connexion.php';
  echo"<link href='style.css' rel='stylesheet' type='text/css'>";
  if (!isset($_POST['idseance']) || empty($_POST['idseance'])){
    echo" <h2> l'id de la seance ne doit pas etre vide </h2>";
    exit();
  }


  $idseance = mysqli_real_escape_string($connect, $_POST['idseance']);

  if (!isset($_POST['ideleve']) || empty($_POST['ideleve'])){
    echo" <h2> l'id de l'eleve ne doit pas etre vide </h2>";
    exit();
  }


  $ideleve = mysqli_real_escape_string($connect, $_POST['ideleve']);

  $query = "SELECT * FROM inscription WHERE idseance ='$idseance' and ideleve = '$ideleve'";
  //recup  les inscriptions correspondants aux ids. on s en sert pour ne pas reinscrire quelqu'un.
  $result = mysqli_query($connect, $query);
  $result3 = mysqli_query($connect, "SELECT COUNT(idseance) FROM inscription WHERE idseance ='$idseance'");
  // calcule le nbr de personnes inscrits a une seance.
  $nbr_inscrits =  mysqli_fetch_array($result3, MYSQLI_NUM);
  $set_eff_max = mysqli_query($connect, "SELECT EffMax FROM seances WHERE idseance ='$idseance'");
  $row_eff_max = mysqli_fetch_assoc($set_eff_max);
  $EffMax = $row_eff_max['EffMax']; //recup effmax de la seance lie a l idseance.
  $inscriptions_restantes = $EffMax - $nbr_inscrits[0];
  if (!$result || !$result3 || !$set_eff_max) {
    echo "<br>Erreur: " . mysqli_error($connect);
    exit();
  }
  if (mysqli_num_rows($result) > 0) { // si eleve deja inscrit on le reinscrit a
    echo "<div class='form-container'><h2>Elève est déjà inscrit à  la séance.</h2></div>
    <a href='inscription_eleve.php'>
        <button type='button' class='btn-simple'>Retour</button>
    </a>
    <a href='accueil.html'>
        <button type='button' class='btn-simple'>Accueil</button>
    </a>";
  } elseif ($inscriptions_restantes <= 0){
    echo "<div class='form-container'><h2>il n'y a plus de place dans la séance.</h2></div>
    <a href='inscription_eleve.php'>
        <button type='button' class='btn-simple'>Retour</button>
    </a>
    <a href='accueil.html'>
        <button type='button' class='btn-simple'>Accueil</button>
    </a>";
  }



  else {
    $query = "INSERT INTO inscription VALUES ('$idseance', '$ideleve', NULL)";
    $result = mysqli_query($connect, $query);
    if (!$result) echo "<br>Erreur: ".mysqli_error($connect);
    else {
      echo "<div class='form-container'><h2>L'élève a été inscrit.</h2></div>
      <a href='inscription_eleve.php'>
          <button type='button' class='btn-simple'>Retour</button>
      </a>
      <a href='accueil.html'>
          <button type='button' class='btn-simple'>Accueil</button>
      </a>";
    	  }
  }
  mysqli_close($connect);

?>