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
$sql = "select users_favourite.id as 'idfav', location.id as 'idloc', location.name as 'name', type.type as 'type', city.name as 'city',
        location.postcode as 'postcode' from location, users_favourite, city, type where users_favourite.location = location.id and users_favourite.user = '$userid'
        and location.city = city.id and location.type=type.id group by users_favourite.id";
$result = $connection->query($sql) or die($connection->error);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(38);?>
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
    $idloc = $row["idloc"];
    echo "<div class='profile-container-2'>";
    $idfav=$row["idfav"];
    echo "<div class='flex-row'>" . $row["type"] . "</div>";
    echo "<div class='flex-row' id='pc2'  onclick='window.location=\"../../guide/search/location/index.php?id=$idloc\"'>" . $row["name"] . "</div>";
    echo "<div class='flex-row'>" . $row["city"] . "</div>";
    echo "<div class='flex-row'>" . $row["postcode"] . "</div>";
    echo "<div class='button-delete' onclick='window.location=\"deletelocation.php?id=$idfav\"'>Usuń z zapisanych</div>";
    echo "<br>";
    echo "</div>";
}?>
<div class="profile-container-2">
    <div class="profile-button" onclick="window.location='../../guide/index.php'">Wszystkie lokacje</div>
</div>

<?php echo $footer;?>
</body>
</html>
