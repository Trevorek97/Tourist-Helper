<?php
include_once ('../database/database.php');
include_once ('../layout.php');
session_start();
if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }

$sql = "select event.id as 'id', event.name as 'name', event.startdate as 'start', event.enddate as 'end', event.description as 'description',
        location.name as 'location' from location, event where event.location=location.id order by start desc limit 5";
$result = $connection->query($sql);

$sql2 = "select id, voivodeship from voivodeship";
$result2 = $connection->query($sql2);
?>


<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(40);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="style_event.css">
</head>
<body>
<?php
if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
else $sesLog = "";
echo showHeader($sesLog, '../index.php', '../profile/index.php', '../login/logout.php', '../login/register.php', '../login/login.php', '../img/avatars/'.$img.'.png');
?>
<br><br><br>
<div class="wrapper">
    <div class="event-container-small">
        <div class="newest-events-title">Najnowsze wydarzenia:</div>
        <div class="flex-container-2">
            <div class="column-flex-title-a">Nazwa</div>
            <div class="column-flex-title-a">Lokacja</div>
            <div class="column-flex-title-b">Początek</div>
            <div class="column-flex-title-b">Koniec</div>
            <?php while($row=$result->fetch_assoc()) {
                $startdate = date_create($row["start"]);
                $enddate = date_create($row["end"]);
                $id=$row["id"];
                echo "<div class='newest-event' onclick='window.location=\"searchevent/event/index.php?id=$id\"'>";
                echo "<span class='column-flex-data-a'>". $row["name"]. "</span>";
                echo "<span class='column-flex-data-a'>". $row["location"]. "</span>";
                echo "<span class='column-flex-data-b'>". date_format($startdate,'d-m-Y'). "</span>";
                echo "<span class='column-flex-data-b'>". date_format($enddate, 'd-m-Y'). "</span>";
                echo "</div><br>";
            }?>
        </div>
    </div>
    <div class="search-container">
        <div class="newest-events-title">Wyszukaj wydarzenia:</div>
        <form class="search-flex" method="POST" action="searchevent/index.php">
            <div class="search-name">Województwo:</div>
            <select name="voivodeship" class="search-input">
                <option value="0"</option>
                <?php while ($row2 = $result2->fetch_assoc()) {
                    $namev = $row2["voivodeship"];
                    $idv = $row2["id"];
                    echo "<option value=$idv> " . $namev . "</option>";
                }?>
            </select>
            <div style="flex: 0 0 100%; height:10px"></div>

            <div class="search-name">Miasto:</div>
            <input class="search-input" name="city">
            <div style="flex: 0 0 100%; height:10px"></div>

            <div class="search-name">Nazwa lokacji:</div>
            <input class="search-input" name="locationname">
            <div style="flex: 0 0 100%; height:10px"></div>

            <input type="submit" class="submit-button" value="Szukaj!">
        </form>
    </div>
</div>

<br><br><br>
<div class="return-container">
    <div class="return" onclick="window.location='../index.php'">Wróć do strony głównej</div>
</div>

<?php echo $footer;?>
</body>
</html>