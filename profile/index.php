<?php
    include_once ('../database/database.php');
    include_once ('../layout.php');
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }

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
        <div class="profile-button" onclick="window.location='changephoto/index.php?&user=<?php echo $sesLog;?>'">Zmień zdjęcie profilowe</div>
        <div class="profile-button" onclick="window.location='favourites/index.php?&user=<?php echo $sesLog;?>'">Przeglądaj ulubione lokacje</div>
        <div class="profile-button" onclick="window.location='deleteaccount/index.php?&user=<?php echo $sesLog;?>'">Usuń konto</div>
    </div>



    <?php echo $footer;?>
</body>
</html>