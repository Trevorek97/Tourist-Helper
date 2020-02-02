<?php
    $host = 'localhost';
    $user = 'root';
    $password = 'DataBasePassword123!';
    $dbname = 'touristhelper';

    $connection = new mysqli($host, $user, $password, $dbname);

    mysqli_query($connection, "SET CHARSET utf8");
    mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

    if($connection->connect_error) {
        die("Wystąpił problem z nawiązaniem połączenia z bazą danych!
            Rodzaj błędu:" . $connection->connect_error);
    }
    else {
        //echo("Nawiązano połączenie z bazą danych!");
        //echo("Nazwa bazy danych: " . $dbname);
    }
    $img='';
?>

