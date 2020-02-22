<?php
include_once('../../database/database.php');
include_once('../../layout.php');
session_start();
include("auth.php");

if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection);}
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(48);?>
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
<form action="trip.php?user=<?php echo $sesLog;?>" method="POST" class="guide-container">
    <div class="guide-title">Tworzenie nowej podróży</div>

    <div class="first-column">Nazwa podróży:</div>
    <div class="second-column">
        <input type="text" name="name" placeholder="Nazwij swoją podróż">
    </div>

    <div class="first-column">Opis podróży:</div>
    <div class="second-column">
        <textarea style="width:95%" name="description" rows="10" maxlength="960" placeholder="Opisz swoją podróż" required></textarea>
    </div>

    <button type='submit' class="guide-button">Utwórz!</button>

    <div class='guide-button' onclick="window.location='../../index.php'">Wróć do menu głównego</div>

</form>
<?php echo $footer;?>


</body>
</html>