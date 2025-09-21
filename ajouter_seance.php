<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet" type="text/css">
  <meta charset="utf-8">
</head>
    <body>
    <?php
    include 'connexion.php';
    date_default_timezone_set('Europe/Paris');
    
    //verif
    if (!isset($_POST['Idtheme']) || empty($_POST['Idtheme'])){
        echo" <h2> l'id du theme ne doit pas etre vide </h2>";
        exit();
    }

    //escape carac spec
    $Idtheme = mysqli_real_escape_string($connect, $_POST['Idtheme']);

    //verif
    if (!isset($_POST['EffMax']) || empty($_POST['EffMax'])){
        echo" <h2> EffMax ne doit pas etre vide </h2>";
        exit();
        }
    
    //escape carac spec
    $EffMax = mysqli_real_escape_string($connect, $_POST['EffMax']);

    if ($EffMax <= 1) {
        echo "<h2> EffMax doit être supérieur à 1 </h2>";
        exit();
    }

    //verif
    if (!isset($_POST['DateSeance']) || empty($_POST['DateSeance'])){
        echo" <h2> la date ne doit pas etre vide </h2>";
        exit();
    }

    //escape carac spec
    $DateSeance = mysqli_real_escape_string($connect, $_POST['DateSeance']);

    if( $DateSeance < date("Y-m-d") ) {
        echo "<h2> la date doit etre superieur ou egal à la date actuelle </h2>";
        exit();
    }
    $query = "SELECT * FROM seances WHERE DateSeance = '$DateSeance' and Idtheme = '$Idtheme'";
    //echo "<br>$query<br>";
    $result = mysqli_query($connect, $query);
    if (!$result) {
        echo "<br>Erreur: " . mysqli_error($connect);
        exit();
    }
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='form-container'>
        <h2>Vous ne pouvez pas créer 2 séances avec le même thème pour la même journée !</h2>
        </div>
        <a href='ajout_seance.php'>
            <button type='button' class='btn-simple'>Retour</button>
        </a>
        <a href='accueil.html'>
            <button type='button' class='btn-simple'>Accueil</button>
        </a>"; } else{
            $query = "insert into seances values (NULL, '$DateSeance', $EffMax, $Idtheme)";
            //echo "<br>$query<br>";
            // important echo a faire systematiquement, c'est impose !

            $result = mysqli_query($connect, $query);

            if (!$result)
            {
                echo "<br>pas bon".mysqli_error($connect);
            }
            echo "<div class='form-container'>
            <h2>La seance qui a pour date ".$DateSeance." effectif max ".$EffMax." et idtheme ".$Idtheme." a été ajouté</h2>
            </div>
            <a href='ajout_seance.php'>
                <button type='button' class='btn-simple'>Retour</button>
            </a>
            <a href='accueil.html'>
                <button type='button' class='btn-simple'>Accueil</button>
            </a>";
    }
        mysqli_close($connect);
        ?>
    </body>
</html>
    
    