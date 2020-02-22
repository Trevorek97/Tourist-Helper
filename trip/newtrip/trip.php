<?php

    include_once('../../database/database.php');
    $user = $_GET["user"];
    $description = $_POST["description"];
    $name = $_POST["name"];
    $sql_login = "select id from users where login = '$user'";
    $result = $connection->query($sql_login);
    $row = $result->fetch_assoc();
    $id = $row["id"];
    $sql = "insert into trip(user, description, name) values ('$id', '$description', '$name')";
    if($connection->query($sql) === TRUE) {
        $msg = "Podróż utworzona! Przejdź do zakładki Twoje podróże by dokonać edycji.";
    } else {
        $msg = "Błąd tworzenia podróży. Spróbuj później";
    }
    header('Location: ../index.php?msg=' . $msg );

?>