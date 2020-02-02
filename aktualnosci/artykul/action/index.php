<?php
    include_once ('../../../database/database.php');
        if($_GET["action"] =='1') {
            $article=$_GET["article"];
            $idcomment = $_GET["id"];
            $sql2 = "delete from article_subcomment where comment='$idcomment'";
            $result2 = $connection->query($sql2) or die($connection->error);
            $sql = "delete from article_comment where id='$idcomment'";
            $result= $connection->query($sql) or die ($connection->error);
            header("Location: ../index.php?article=$article");

        } else if($_GET["action"] =='2') {
            $article=$_GET["article"];
            $idcomment = $_GET["id"];
            $sql = "delete from article_subcomment where id='$idcomment'";
            $result= $connection->query($sql);
            header("Location: ../index.php?article=$article");

        } else if ($_POST["action"] =='3') {
            $user = $_POST["user"];
            $idcom = $_POST["id"];
            $content = $_POST["content"];
            $article = $_POST["article"];
            $sql = "select id from users where login = '$user'";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $userid = $row["id"];
            $sql2 = "insert into article_subcomment(author,content, comment) values ('$userid', '$content', '$idcom')";
            $result2 = $connection->query($sql2);
            header("Location: ../index.php?article=$article");
        }  else if ($_POST["action"] =='4') {
            $user = $_POST["user"];
            $article = $_POST["article"];
            $content = $_POST["content"];
            $sql = "select id from users where login = '$user'";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $userid = $row["id"];
            $sql2 = "insert into article_comment(author, content, article) values ('$userid', '$content', '$article')";
            $result2 = $connection->query($sql2) or die ($connection->error);
            header("Location: ../index.php?article=$article");
        } else {
            header("Location: ../../../index.php");
        }
?>
