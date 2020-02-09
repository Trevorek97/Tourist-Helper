<?php
include_once("../../../database/database.php");
$userlogin = $_GET["user"];
$event = $_GET["event"];

$sql0 = "select id as 'id' from users where login = '$userlogin'";
$result0 = $connection->query($sql0)  or die ($connection->error);
$row = $result0->fetch_assoc();
$user=$row["id"];

    $sql = "select event_favourite.id from event_favourite, event, users where event_favourite.user = users.id
    and event_favourite.event = event.id and event.id = '$event' and users.id = '$user'";
    $result = $connection->query($sql);
    if($result->num_rows == 0) {
        $sql2 = "insert into event_favourite(user, event) values('$user', '$event')";
        $result2=$connection->query($sql2) or die ($connection->error);
        $message = 0;
    }
    else {
        $sql2 = "delete from event_favourite where event = '$event' and user = '$user'";
        $result2 = $connection->query($sql2)  or die ($connection->error);
        $message = 1;
    }

header("Location: index.php?id=$event&message=$message");
exit;
?>