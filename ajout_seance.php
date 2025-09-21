<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet" type="text/css">
  <meta charset="utf-8">
</head>
<body>
<?php
include "connexion.php";

$result = mysqli_query($connect, "SELECT idtheme, nom, descriptif FROM themes WHERE supprime = 0");

echo "<div class='form-container'>"; // Ouvrir la div pour le formulaire

echo "<form method='POST' action='ajouter_seance.php'>
    <table>
        <tr>
            <td>
            <select name='Idtheme' required>";

while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    $Idtheme = htmlspecialchars($row[0],ENT_QUOTES, 'UTF-8');
    $nom = htmlspecialchars($row[1],ENT_QUOTES, 'UTF-8');
    $descriptif = htmlspecialchars($row[2],ENT_QUOTES, 'UTF-8');
    echo "<option value='$Idtheme'>$nom: $descriptif</option>\n";
}

echo "      </select>
            </td>
        </tr>
        <tr>
            <td>
            <input type='number' name='EffMax' placeholder='effectif maximum' min='1' required>
            </td>
        </tr>
        <tr>
            <td>
                <input type='date' name='DateSeance' min='".date('Y-m-d')."' required>";
echo"
            </td>
        </tr>
        <tr>
            <td>
                <input type='submit' value='Enregistrer séance'>
            </td>
        </tr>
    </table>
</form>";

echo "</div>"; // Fermer la div pour le formulaire

mysqli_close($connect);
?>
</body>
</html>
