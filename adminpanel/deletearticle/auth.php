<?php
if(isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    $sql = "select admin from users where login ='$login'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    if($row['admin'] != '1') {
        header("Location: ../../index.php");
        exit(); }
}
if(!isset($_SESSION['login'])) {
    header("Location: ../../index.php");
    exit();
}
?>