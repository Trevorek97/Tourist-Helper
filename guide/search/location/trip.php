<?php
include_once('../../../database/database.php');
$location = $_GET["location"];
$trip = $_POST["trip"];

$sql = "insert into triplocation(location,trip) values ('$location', '$trip')";
$result = $connection->query($sql);

header("Location: index.php?id=$location");



?>