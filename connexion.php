<?php
    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92p052';
    $dbpass = '2kZhr91eUucW';
    $dbname = 'nf92p052'; 
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error
    connecting to mysql');
    /*la ligne suivante permet d'éviter les problèmes d'accent entre la page
ouèbe et le serveur mysql, les données envoyées vers mysql sont
encodées en UTF-8 */
    mysqli_set_charset($connect, 'utf8');
    ?>


