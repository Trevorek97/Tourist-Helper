<?php

function useraction($connection, $id, $login, $reason) {

    if($reason == '1') {
        $sqlfavloc = "delete from users_favourite where id = '$id'";
        $resultfavloc = $connection->query($sqlfavloc);
        $sqlfavevent = "delete from event_favourite where id = '$id'";
        $resultfavevent = $connection->query($sqlfavevent);
        $sqltrip = "select id from trip where user='$id'";
        $resulttrip = $connection->query($sqltrip);
        $rowtrip = $resulttrip->fetch_assoc();
        $tripid = $rowtrip["id"];
        $sqltriplocation = "delete from triplocation where trip = '$tripid'";
        $resulttriplocation = $connection->query($sqltriplocation);
        $sqltrip2 = "delete from trip where user='$id'";
        $resulttrip2 = $connection->query($sqltrip2);
        $sql = "update users set name='', surname='', email='', login='Konto usunięte', password='', admin='0' where id = '$id'";
        $result = $connection->query($sql);
        $message = "Usunięto użytkownika $login!";
    } elseif ($reason == '2') {
        $sql = "update users set admin = '1' where id = '$id'";
        $result = $connection ->query($sql);
        $message = "Użytkownik $login nabył prawa administratora!";
    } elseif ($reason == '3') {
        $sql = "update users set admin = '0' where id = '$id'";
        $result = $connection->query($sql);
        $message = "Użytkownik $login nie jest już dłużej administratorem";
    }
return $message;
}


?>