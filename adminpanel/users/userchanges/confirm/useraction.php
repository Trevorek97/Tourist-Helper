<?php

function useraction($connection, $id, $login, $reason) {

    if($reason == '1') {
        $sql = "delete from users where id = '$id'";
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