<?php
include_once('../../../database/database.php');
$user = $_GET["id"];
$sql = "select id from users where login='$user'";
$result = $connection->query($sql) or die($connection->error);
$row=$result->fetch_assoc();
$userid = $row["id"];

$sql2 = "delete from users_favourite where user='$userid'";
$resul2=$connection->query($sql2) or die($connection->error);

$sql3 = "update users set name='', surname='', email='', login='Konto usunięte', password='' where id='$userid' ";
$result3=$connection->query($sql3) or die($connection->error);
header("Location: ../../../login/logout.php");

?>