<?php
    include_once ('../../database/database.php');
    include_once ('../../layout.php');
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $sql = "select * from location";
    $result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(6);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../style_admin.css">
</head>

<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/'.$img.'.png');
    ?>
    <br><br><br>

    <div class="admcontainer" style="width:80%">
        <div class="flex-container-2">
            <div class='column-flex-1 '><h3>ID</h3></div>
            <div class='column-flex-1'><h3>Typ</h3></div>
            <div class='column-flex-2'><h3>Nazwa</h3></div>
            <div class='column-flex-2'><h3>Miasto</h3></div>
            <div class='column-flex-2'><h3>Województwo</h3></div>
            <div class='column-flex-2'><h3>Kod pocztowy</h3></div>
            <div class='column-flex-2'><h3>Usuń</h3></div>

            <?php
                while ($row = $result->fetch_assoc())
                {
                    $id = $row["id"];
                    $name = $row["name"];
                    $rc = $row["city"];
                    $sql2 = "select city.name as 'c', voivodeship.voivodeship as 'v' from city, voivodeship
                    where city.id='$rc' and city.voivodeship=voivodeship.id";
                    $result2 = $connection->query($sql2);
                    $row2 = $result2->fetch_assoc();

                    echo "<div class='column-flex-1'>" . $row["id"] . "</div>";
                    echo "<div class='column-flex-1'>" . $row["type"] . "</div>";
                    echo "<div class='column-flex-2'>" . $row["name"] . "</div>";
                    echo "<div class='column-flex-2'>" . $row2["c"] . "</div>";
                    echo "<div class='column-flex-2'>" . $row2["v"] . "</div>";
                    echo "<div class='column-flex-2'>" . $row["postcode"] . "</div>";
                    echo "<div class='column-flex-2'>" . "<div class='button-delete' onclick=\"document.location='deleted/index.php?deleted=$id&name=$name'\">X</div>" . "</div>";
                }
            ?>
        </div>
    </div>
    <?php echo $footer;?>
</body>
</html>