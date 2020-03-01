<?php
include_once('../../database/database.php');
include_once('../../layout.php');
session_start();
include("auth.php");

if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection);}
$login = $_SESSION["login"];
$sql = "select trip.id as 'id', trip.name as 'name' from trip, users where users.id = trip.user and users.login = '$login'";
$result = $connection->query($sql) or die ($connection->error);
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(49);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../tourist.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../style_trip.css">
    <link rel="stylesheet" type="text/css" href="../../guide/style_guide.css">



</head>
<body>
<?php
if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
else $sesLog = "";
echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/'.$img.'.png' );
?>
<br><br><br>
    <div class="search-container" style="width:40%">
        <div class="search-b">Identyfikator</div>
        <div class="search-b">Nazwa podróży</div>
    </div>
        <?php while ($row = $result->fetch_assoc()) {
          $id = $row["id"];
          $name = $row["name"];
          echo "<div class='search-container' style='width:40%' onclick='window.location=\"tripdetails/index.php?id=$id\"'>";
          echo "<div class='search-b'>" . $id . "</div>";
          echo "<div class='search-b'>" . $name . "</div>";
          echo "</div>";
          echo "<div class='search-b'><span class='button-removetrip' onclick='window.location=\"delete.php?trip=$id\"'>Usuń podróż $name</span></div>";

        }
        ?>

<br><br><br>
<div class="return-container">
    <div class="return" onclick="window.location='../../index.php'">Wróć do strony głównej</div>
</div>
<?php echo $footer;?>


</body>
</html>