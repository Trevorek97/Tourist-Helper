<?php
    include_once('../../database/database.php');
    include_once('../../layout.php');
    session_start();
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $log = $_SESSION["login"];
    $sql0 = "select id from users where login='$log'";
    $result0=$connection->query($sql0);
    $row0 = $result0->fetch_assoc();
    $userid = $row0["id"];
    $sql = "select event_favourite.id as 'id', location.id as 'idloc', event.id as 'idev', event.name as 'eventname', location.name as 'eventlocation', event.startdate as 'startdate', 
            event.enddate as 'enddate' from event, location, users, event_favourite where event.id = event_favourite.event
            and event_favourite.user = '$userid'  and event.location = location.id and event.enddate >= current_date group by event_favourite.id";
    $result = $connection->query($sql);
    ?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(45);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../style_profile.css">

</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/'.$img.'.png');
    ?>
<br><br><br>

         <?php while($row=$result->fetch_assoc()) {
             $idev = $row["idev"];
             $idloc = $row["idloc"];
             echo "<div class='profile-container-2'>";
             $startdate = date_create($row["startdate"]);
             $enddate = date_create($row["enddate"]);
             $idevent=$row["id"];
             echo "<div class='flex-row'   id='pc2' onclick='window.location=\"../../events/searchevent/event/index.php?id=$idev\"'> " . $row["eventname"] . "</div>";
             echo "<div class='flex-row' id='pc2' onclick='window.location=\"../../guide/search/location/index.php?id=$idloc\"'>" . $row["eventlocation"] . "</div>";
             echo "<div class='flex-row'>" . date_format($startdate, 'd-m-Y') . "</div>";
             echo "<div class='flex-row'>" . date_format($enddate, 'd-m-Y') . "</div>";
             echo "<div class='button-delete' onclick='window.location=\"deleteevent.php?id=$idevent\"'>Usuń z zapisanych</div>";
                echo "<br>";
                echo "</div>";
         }?>
    <div class="profile-container-2">
        <div class="profile-button" onclick="window.location='../../events/index.php'">Wszystkie wydarzenia</div>
    </div>

<?php echo $footer;?>
</body>
</html>
