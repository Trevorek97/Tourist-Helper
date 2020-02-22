<?php
include_once('../database/database.php');
$distance = $_POST["distance"];
$login = $_GET["login"];
$sql = "update users set distance = '$distance' where login = '$login'";
$connection->query($sql);

header("Location: index.php");

?>