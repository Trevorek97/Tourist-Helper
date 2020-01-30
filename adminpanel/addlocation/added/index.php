<?php
    include_once('../../../database/database.php');
    include_once('../../../layout.php');
    include_once('addlocation.php');
    session_start();
    include("auth.php");

    $link = $_POST["link"];
    $type = $_POST["type"];
    $voivodeship = $_POST["voivodeship"];
    $city = $_POST["city"];
    $street = $_POST["street"];
    $number = $_POST["number"];
    $postcode = $_POST["postcode"];
    $name = $_POST["name"];
    $position = $_POST["position"];
    $description = $_POST["description"];
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(22);?>
    <?php echo $headInfo;?>
    <link rel="icon" href="../../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <script type="text/javascript" src="../../../tourist.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../style.css">
    <link rel="stylesheet" type="text/css" href="../../style_admin.css">
</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../../../index.php', '../../../profile/index.php', '../../../login/logout.php', '../../../login/register.php', '../../../login/login.php', '../../../img/avatars/default.png');
    ?>
    <br><br><br>
    <?php
        $sql = "select id as 'idcity' from city where name='$city' and voivodeship='$voivodeship'";
        $result=$connection->query($sql);
        if($result->num_rows <= 0) {
            $sql2 = "insert into city(name, voivodeship) values ('$city', '$voivodeship') ";
            $result2 = $connection->query($sql2);
            $sql3 = "select id as 'idcity' from city where name= '$city' and voivodeship = '$voivodeship' ";
            $result3 = $connection->query($sql3);
            while($row = $result3->fetch_assoc()) { $id_city = $row["idcity"]; }
        }
        else {
            $row = $result->fetch_assoc();
            $id_city = $row["idcity"];
        }
        $position = str_replace(",", ".", $position);
        $sql = "insert into location(name, description, type, city, street, number, postcode, position)
        values('$name', '$description', '$type', '$id_city', '$street', '$number', '$postcode', '$position')";
        $connection->query($sql);

        $sql = "select id from location where name='$name' and description='$description'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $id_location = $row["id"];

        $res = addPhotos($link, $id_location, $connection);
    ?>

    <div class=admcontainer>
        <h2 class='confirm-add'><?php echo $res; ?></h2>
        <h2 class="confirm-add" style="font-size:30px"> <?php echo $name; ?></h2>
        <div class="button-return" onclick="document.location='../../index.php'">Wróć do panelu</div>
        <div class="button-list" onclick="document.location='../../deletelocation/index.php'">Wyświetl wszystkie lokacje</div>
        <div class="button-next" onclick="document.location='../index.php'">Dodaj kolejną lokację</div>

    </div>

<?php echo $footer;?>
</body>
</html>


