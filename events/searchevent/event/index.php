<?php
include_once ('../../../database/database.php');
include_once ('../../../layout.php');
session_start();
if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
$getid = $_GET["id"];
$sql = "select event.id as 'eventid', event.name as 'eventname', event.description as'description', 
        event.startdate as 'startdate', event.enddate as 'enddate', location.id as 'locationid', location.name as'locationname'
        from event, location where location.id = event.location and event.id = '$getid'";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
$startdate = date_create($row["startdate"]);
$enddate = date_create($row["enddate"]);
$id=$row["eventid"];
$locationid=$row["locationid"];
$user = $_SESSION["login"];

if(!isset($_GET["message"])) {
    $sql0 = "select id as 'id' from users where login = '$user'";
    $result0 = $connection->query($sql0)  or die ($connection->error);
    $row0 = $result0->fetch_assoc();
    $userid=$row0["id"];
    $sql2 = "select event_favourite.id from event_favourite, event, users where event.id = event_favourite.event and users.id = '$userid' and event_favourite.user=users.id  and event.id='$id'";
    $result2 = $connection->query($sql2) or die($connection->error);
    if($result2 -> num_rows == 0) {$message ="Zapisz wydarzenie!";}
    else {$message = "Usuń z zapisanych!";}
}
else {
    if($_GET["message"] == 0) {$message = "Usuń z zapisanych!";}
    else {$message = "Zapisz wydarzenie!";}
}

$sql3 = "select name from location where id='$locationid'";
$result3 =$connection->query($sql3);
$row3 = $result3->fetch_assoc();
$locationname=$row3["name"];
?>


<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(41);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../../style.css">
    <link rel="stylesheet" type="text/css" href="../../style_event.css">
</head>
<body>
<?php
if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
else $sesLog = "";
echo showHeader($sesLog, '../../../index.php', '../../../profile/index.php', '../../../login/logout.php', '../../../login/register.php', '../../../login/login.php', '../../../img/avatars/'.$img.'.png');
?>
<br><br><br>
    <div class="event-data">
        <?php echo "<div class='event-title'>" . $row["eventname"] . " w " . $row["locationname"] ."</div>";?>
        <?php echo "<div class='event-date'>Zaczyna się: " . date_format($startdate,'d-m-Y')  . "</div>";?>
        <?php echo "<div class='event-date'>Kończy się: " . date_format($enddate, 'd-m-Y') . "</div>";?>
        <?php echo "<div class='event-location' onclick='window.location=\"../../../guide/search/location/index.php?id=$locationid\"'>Miejsce: " . $locationname . "</div>";?>
        <div class="event-description"><?php echo $row["description"];?></div>
        <br>
        <?php
            echo "<div class='event-favourite' onclick='window.location=\"setfavourite.php?user=$user&event=$id\"'>$message</div>";
            echo "<br>";
            echo "<div class='event-map' onclick='window.location=\"../../../mapa/index.php?location=$locationid\"'>Pokaż na mapie</div>";
        ?>
        <br>
        <div class="button-return" onclick='window.location="../../index.php"'>Powrót</div>
        <br>
    </div>
<?php echo $footer;?>
</body>
</html>