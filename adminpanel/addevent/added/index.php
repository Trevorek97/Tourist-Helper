<?php
    include_once("../../../database/database.php");
    include_once("../../../layout.php");
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $name = $_POST["name"];
    $location = $_POST["location"];
    $startdate = $_POST["startdate"];
    $enddate = $_POST["enddate"];
    $description = $_POST["description"];
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(20);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../../tourist.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../style.css">
    <link rel="stylesheet" type="text/css" href="../../style_admin.css">

</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../../../index.php', '../../../profile/index.php', '../../../login/logout.php', '../../../login/register.php', '../../../login/login.php', '../../../img/avatars/'.$img.'.png');
    ?>
    <br><br><br>

    <?php
        $sql = "insert into event(name, startdate, enddate, location, description) values ('$name', '$startdate', '$enddate', '$location', '$description')";
        if($connection->query($sql) === TRUE) {
            $res = "Dodano wydarzenie $name!";
        } else {
            $res = "Błąd dodawania wydarzenia!";
        }
    ?>

    <div class=admcontainer>
        <h2 class='confirm-add' style='font-size:16px'><?php echo $res; ?></h2>
        <div class="button-return" onclick="document.location='../../index.php'">Wróć do panelu</div>
        <div class="button-list" onclick="document.location='../../deleteevent/index.php'">Wyświetl wszystkie wydarzenia</div>
        <div class="button-next" onclick="document.location='../index.php'">Dodaj kolejne wydarzenie</div>
    </div>

    <?php echo $footer;?>
</body>
</html>


