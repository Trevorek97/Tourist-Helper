<?php
include_once ('../../database/database.php');
include_once ('../../layout.php');
include_once('searchevent.php');
session_start();
if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }

$voivodeship = $_POST["voivodeship"];
$city = $_POST["city"];
$name = $_POST["locationname"];

$result =  searchevent($connection, $city, $voivodeship, $name);

?>


<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(41);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../style_event.css">
</head>
<body>
<?php
if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
else $sesLog = "";
echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/'.$img.'.png');
?>
<br><br><br>

    <div class="eventlist-container">
        <div class="newest-events-title">Znalezione wydarzenia:</div>
            <div class='eventlist-flex-b'>
                <div class="column-flex-data-a">Nazwa wydarzenia</div>
                <div class="column-flex-data-a">Miejsce</div>
                <div class="column-flex-data-b">Poczatek</div>
                <div class="column-flex-data-b">Koniec</div>
            </div>
                <?php while ($row = $result->fetch_assoc()) {
                    $id=$row["id"];
                echo"<div class='eventlist-flex' onclick='window.location=\"event/index.php?id=$id\"'>";
                echo "<div class='column-flex-data-a' style='font-weight:600'>" . $row["name"] . "</div>";
                echo "<div class='column-flex-data-a'>" . $row["locationname"] . "</div>";
                echo "<div class='column-flex-data-b'>" . $row["startdate"] . "</div>";
                echo "<div class='column-flex-data-b'>" . $row["enddate"] . "</div>";
                echo "</div>";
            }?>


    </div>
<?php echo $footer;?>
</body>
</html>