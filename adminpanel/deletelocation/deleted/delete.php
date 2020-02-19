<?php

    include_once('../../../database/database.php');

    function deleteLocation($connection, $id)
    {
        if (empty($id)) {
            $message = "Błąd! Brakuje ID ogłoszenia do skasowania!";
            return $message;
        }
        $sql0 = "select id from location_comment where location='$id'";
        $result0 = $connection->query($sql0);
        while ($row = $result0->fetch_assoc()) {
            $tmp = $row["id"];
            $sql1 = "delete from location_subcomment where comment='$tmp'";
            $connection->query($sql1);
        }
        $sql2 = "delete from location_comment where location = '$id'";
        $connection->query($sql2);

        $sql3 = "delete from users_favourite where location='$id'";
        $connection->query($sql3);

        $sql4 = "delete from location_rate where location='$id'";
        $connection->query($sql4);

        $sql5 = "delete from photo where location= '$id' ";
        $connection->query($sql5);

        $sql6 = "delete from location where id = '$id' ";
        if ($connection->query($sql6) === TRUE) {
            $message = "Usunięto lokację!";
        } else {
            $message = "Błąd usuwania lokacji!";
        }
        return $message;
    }
?>