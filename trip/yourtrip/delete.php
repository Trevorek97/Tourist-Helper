<?php
include_once('../../database/database.php');
$trip = $_GET["trip"];
$sql = "delete from triplocation where trip='$trip'";
$connection->query($sql) or die ($connection->error);

$sql2 = "delete from trip where id = '$trip'";
$connection->query($sql2) or die ($connection->error);

header("Location: index.php");

?>