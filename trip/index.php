<?php
include_once('../database/database.php');
include_once('../layout.php');
session_start();
include("auth.php");

if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection);}
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(47);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../tourist.js"></script>
    <link rel="icon" href="../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="style_trip.css">


</head>
<body>
<?php
if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
else $sesLog = "";
echo showHeader($sesLog, '../index.php', '../profile/index.php', '../login/logout.php', '../login/register.php', '../login/login.php', '../img/avatars/'.$img.'.png' );
?>
<br><br><br>
<?php
    if(isset($_GET["msg"])) {
        echo "<div class='tripcontainer'>
                <div class='triptitle'>" . $_GET['msg'] . "</div></div>";
    }
?>
<div class=tripcontainer>
    <h2 class='triptitle'>Planowanie podróży</h2>
    <div class="button-newtrip" onclick="window.location='newtrip/index.php'">Nowa podróż!</div>
    <div class="button-yourtrip" onclick="window.location='yourtrip/index.php'">Twoje podróże</div>
</div>


<br><br><br>
<div class="return-container">
    <div class="return" onclick="window.location='../index.php'">Wróć do strony głównej</div>
</div>

<?php echo $footer;?>


</body>
</html>