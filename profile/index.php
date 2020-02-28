<?php
    include_once ('../database/database.php');
    include_once ('../layout.php');
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $log = $_SESSION["login"];
    $sql = "select distance from users where login = '$log'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $distance = $row["distance"];


?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(35);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../tourist.js"></script>
    <link rel="icon" href="../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="style_profile.css">
</head>
<body>
    <?php
    $sesLog = $_SESSION['login'];
    echo showHeader($sesLog, '../index.php', '../profile/index.php', '../login/logout.php', '../login/register.php', '../login/login.php', '../img/avatars/'.$img.'.png');
    ?>
    <br><br><br>

    <div class="profile-container">
        <div class="profile-name">Profil użytkownika <?php echo $_SESSION["login"];?></div>
        <img class="profile-photo" src="../img/avatars/<?php echo $img;?>.png">
        <div class="profile-button" onclick="window.location='changedata/index.php?&user=<?php echo $sesLog;?>'">Zmień swoje dane</div>
        <div class="profile-button" onclick="window.location='changephoto/index.php?&user=<?php echo $sesLog;?>'">Wybierz zdjęcie</div>
        <div class="profile-button" onclick="window.location='favourites_location/index.php?&user=<?php echo $sesLog;?>'">Ulubione lokacje</div>
        <div class="profile-button" onclick="window.location='favourites_events/index.php?&user=<?php echo $sesLog;?>'">Zapisane wydarzenia</div>
        <div class="profile-button" onclick="window.location='../trip/yourtrip/index.php'">Twoje podróże</div>
        <div class="profile-button" onclick="window.location='deleteaccount/index.php?&user=<?php echo $sesLog;?>'">Usuń konto</div>
        <div class="profile-distancetitle">Dystans wyszukiwania lokacji w pobliżu:</div>
        <form class="formdistance" method="POST" action="distance.php?login=<?php echo $log;?>">
            <input class="inputdistance" type="number" min="1" name="distance" value="<?php echo $distance;?>">
            <button class="inputbuttondistance" type="submit">Ustaw</button>
        </form>
    </div>



    <?php echo $footer;?>
</body>
</html>