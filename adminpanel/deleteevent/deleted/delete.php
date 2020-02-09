<?php

    include_once('../../../database/database.php');

    function deleteEvent($connection, $id, $name, $location)
    {
        if(empty($id)) {
            $message = "Błąd! Brakuje ID wydarzenia do skasowania!";
            return $message;
        }

        $sql = "delete from event_favourite where event ='$id'";
        if($connection->query($sql) === TRUE ) {
            $sql2 = "delete from event where id = '$id' ";
            if ($connection->query($sql2) === TRUE) {
                $message = "Usunięto wydarzenie $name w $location!";
            } else {
                $message = "Błąd usuwania wydarzenia $name w $location!";
            }

        } else {
            $message = "Błąd usuwania wydarzenia $name w $location!";
        }
        return $message;
    }
?>