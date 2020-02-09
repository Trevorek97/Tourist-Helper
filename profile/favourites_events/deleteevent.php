<?php
include_once('../../database/database.php');
$id = $_GET["id"];

$sql = "delete from event_favourite where id = '$id'";
$result = $connection->query($sql);

header('Location: index.php');

?>