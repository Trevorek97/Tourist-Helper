<?php
include_once('../database/database.php');
session_start();
// Destroying All Sessions
if(session_destroy())
{
// Redirecting To Home Page
    $userip = $_SERVER["REMOTE_ADDR"];
    $userbrowser = $_SERVER["HTTP_USER_AGENT"];
    $login = $_GET["login"];
    $sql = "select id from users where login = '$login'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $userid = $row["id"];
    $sql2 = "delete from active_session where ip= '$userip' and user='$userid' and browser = '$userbrowser'";
    $connection->query($sql2);
    header("Location: ../");
}
?>