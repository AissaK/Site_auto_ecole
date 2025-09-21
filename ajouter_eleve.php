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
    $date = date("Y\-m\-d");


    if (isset($_POST['confirm'])){
    
    if(!empty($_POST['confirm']) && $_POST['confirm'] === 'Oui') {
        // Vérification des entrées
        if (!isset($_POST['nom']) || empty($_POST['nom'])) {
            echo "<h2>Le nom ne doit pas être vide</h2>";
            exit();
        }

        if (!isset($_POST['prenom']) || empty($_POST['prenom'])) {
            echo "<h2>Le prénom ne doit pas être vide</h2>";
            exit();
        }

        if (!isset($_POST['dateNaiss']) || empty($_POST['dateNaiss'])) {
            echo "<h2>La date de naissance ne doit pas être vide</h2>";
            exit();
        }


        // Échapper les caractères spéciaux
        $nom = mysqli_real_escape_string($connect, $_POST['nom']);
        if(mb_strlen($nom) > 30) {
            echo "<h2> le nom ne doit pas depasser 30 caractere </h2>";
            exit();
        }
        $prenom = mysqli_real_escape_string($connect, $_POST['prenom']);
        if(mb_strlen($prenom) > 30) {
            echo "<h2> le prenom ne doit pas depasser 30 caractere </h2>";
            exit();
            }
        $dateNaiss = mysqli_real_escape_string($connect, $_POST['dateNaiss']);
        if( strtotime($dateNaiss) > strtotime("- 16 years")){
            echo "<h2>Inscription à partir de 16 ans.</h2>";
            exit();
        }
        // Insertion de l'élève si confirmation
        $query = "INSERT INTO eleves VALUES (NULL,'$nom', '$prenom', '$dateNaiss', '$date')";
        $result = mysqli_query($connect, $query);
    
        if (!$result) {
            echo "<br>Erreur d'insertion: " . mysqli_error($connect);
        } else {
            echo "<div class='form-container'>
            <h2>L'élève a été ajouté avec succès.</h2>
            </div>
            <a href='ajout_eleve.html'>
                <button type='button' class='btn-simple'>Retour</button>
            </a>
            <a href='accueil.html'>
                <button type='button' class='btn-simple'>Accueil</button>
            </a>";
        }
    } elseif (!empty($_POST['confirm']) && $_POST['confirm'] === 'Non') {//annulation si non
        echo "<div class='form-container'><h2>Ajout de l'élève annulé.</h2></div>
        <a href='ajout_eleve.html'>
            <button type='button' class='btn-simple'>Retour</button>
        </a>
        <a href='accueil.html'>
            <button type='button' class='btn-simple'>Accueil</button>
        </a>";
    } else {
        echo"<div class='form-container'>
        <h2> confirm a été modifié, pk avez vous fais ca monsieur<h2>
        </div>
        <a href='ajout_eleve.html'>
            <button type='button' class='btn-simple'>Retour</button>
        </a>
        <a href='accueil.html'>
            <button type='button' class='btn-simple'>Accueil</button>
        </a>";
    }
    } else {
        $query = "INSERT INTO eleves VALUES (NULL, '$nom', '$prenom', '$dateNaiss','$date')";
    //echo "<br>$query<br>";
    // important echo a faire systematiquement, c'est impose !
    $result = mysqli_query($connect, $query);
    // $query utilise comme parametre de mysqli_query
    // le test ci-dessous est desormais impose pour chaque appel de :
    // mysqli_query($connect, $query);
    if (!$result)
    {
        echo "<br>pas bon".mysqli_error($connect);
    }
    
    //echo "<br> la date est : "."'$date'"." <br>";
    echo "<div class='form-container'>
            <h2>L'élève". $nom." " .$prenom ." a été ajouté avec succès.</h2>";
    echo"        </div>
            <a href='ajout_eleve.html'>
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
    
    