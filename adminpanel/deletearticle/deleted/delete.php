<?php

    include_once('../../../database/database.php');

    function deleteArticle($connection, $id)
    {
        if(empty($id)) {
            $message = "Błąd! Brakuje ID artykułu do skasowania!";
            return $message;
        }

        $sql = "delete from article where id = '$id' ";

        if ($connection->query($sql) === TRUE) {
            $message = "Usunięto artykuł!";
        } else {
            $message = "Błąd usuwania artykułu!";
        }
        return $message;
    }
?>