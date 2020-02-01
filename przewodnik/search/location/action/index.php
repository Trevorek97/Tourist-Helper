<?php
    include_once ('../../../../database/database.php');
        if($_GET["action"] =='1') {
            $location=$_GET["location"];
            $idcomment = $_GET["id"];
            $sql2 = "delete from location_subcomment where comment='$idcomment'";
            $result2 = $connection->query($sql2) or die($connection->error);
            $sql = "delete from location_comment where id='$idcomment'";
            $result= $connection->query($sql) or die ($connection->error);
            header("Location: ../index.php?id=$location");

        } else if($_GET["action"] =='2') {
            $location=$_GET["location"];
            $idcomment = $_GET["id"];
            $sql = "delete from location_subcomment where id='$idcomment'";
            $result= $connection->query($sql);
            header("Location: ../index.php?id=$location");

        } else if ($_POST["action"] =='3') {
            $user = $_POST["user"];
            $idcom = $_POST["id"];
            $content = $_POST["content"];
            $location = $_POST["location"];
            $sql = "select id from users where login = '$user'";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $userid = $row["id"];
            $sql2 = "insert into location_subcomment(author,content, comment) values ('$userid', '$content', '$idcom')";
            $result2 = $connection->query($sql2);
            header("Location: ../index.php?id=$location");
        } else if($_GET["action"] == '5') {
            $user = $_GET["user"];
            $rate = $_GET["rate"];
            $location=$_GET["location"];
            $sql = "select id from users where login = '$user'";
            $result=$connection->query($sql) or die($connection->error);
            $row = $result->fetch_assoc();
            $userid = $row["id"];
            $sql2 = "insert into location_rate(author, location, rate) values ('$userid', '$location', '$rate')";
            $result2 = $connection->query($sql2) or die($connection->error);
            header("Location: ../index.php?id=$location");

        } else if ($_POST["action"] =='4') {
            $user = $_POST["user"];
            $location = $_POST["location"];
            $content = $_POST["content"];
            $sql = "select id from users where login = '$user'";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $userid = $row["id"];
            $sql2 = "insert into location_comment(author, content, location) values ('$userid', '$content', '$location')";
            $result2 = $connection->query($sql2) or die ($connection->error);
            header("Location: ../index.php?id=$location");
        } else if ($_GET["action"] =='6') {
            $location = $_GET["location"];
            $user = $_GET["user"];
            $sql = "select id from users where login = '$user'";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $userid = $row["id"];
            $sql2 = "insert into users_favourite(user,location) values('$userid', '$location')";
            $result2 = $connection->query($sql2);
            header("Location: ../index.php?id=$location");
        } else if ($_GET["action"] == '7') {
            $location = $_GET["location"];
            $user = $_GET["user"];
            $sql = "select id from users where login = '$user'";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $userid = $row["id"];
            $sql2 = "delete from users_favourite where user='$userid' and location='$location'";
            $result2 = $connection->query($sql2);
            header("Location: ../index.php?id=$location");
        } else {
            header("Location: ../../../index.php");
        }
?>
