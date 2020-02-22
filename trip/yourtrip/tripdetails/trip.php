<?php
include_once('../../../database/database.php');
$location = $_GET["location"];
$trip = $_GET["trip"];
$sql = "delete from triplocation where location='$location' and trip='$trip'";
$connection->query($sql) or die ($connection->error);
header("Location: index.php?id=$trip");




?>