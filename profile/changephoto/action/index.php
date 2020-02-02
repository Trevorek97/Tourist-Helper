<?php
include_once('../../../database/database.php');
    $img = $_GET["img"]+1;
    $user = $_GET["user"];
    $sql = "update users set image='$img' where login='$user'";
    $result=$connection->query($sql);
    header("Location: ../../index.php");
?>

