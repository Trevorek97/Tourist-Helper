<?php

    include_once('../../../database/database.php');

    function deleteArticle($connection, $id)
    {
        if(empty($id)) {
            $message = "Błąd! Brakuje ID artykułu do skasowania!";
            return $message;
        }
        $sql0 = "select id from article_comment where article = '$id'";
        $result0 = $connection->query($sql0);
        while ($row0 = $result0->fetch_assoc()) {
            $tmp= $row0["id"];
            $sql1 = "delete from article_subcomment where comment = '$tmp'";
            $connection->query($sql1);
        }
        $sql2 = "delete from article_comment where article ='$id'";
        $connection->query($sql2);

        $sql = "delete from article where id = '$id' ";
        if ($connection->query($sql) === TRUE) {
            $message = "Usunięto artykuł!";
        } else {
            $message = "Błąd usuwania artykułu!";
        }
        return $message;
    }
?>