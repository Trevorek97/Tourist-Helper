<?php

    include_once('../../../database/database.php');

    function deleteLocation($connection, $id)
    {
        if(empty($id)) {
            $message = "Błąd! Brakuje ID ogłoszenia do skasowania!";
            return $message;
        }

        $sql = "delete from location where id = '$id' ";
        $sql2 = "delete from photo where location= '$id' ";

        if ($connection->query($sql) === TRUE && $connection->query($sql2) === TRUE) {
            $message = "Usunięto lokację!";
        } else {
            $message = "Błąd usuwania lokacji!";
        }
        return $message;
    }
?>