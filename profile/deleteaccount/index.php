<?php
    include_once('../../database/database.php');
    include_once('../../layout.php');
    session_start();
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }

?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(39);?>
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
    <?php $user = $_GET["user"];?>
    <div class="profile-container">
        <div class="profile-name">Czy na pewno chcesz usunąć swoje konto <?php echo $user;?>?</div>
        <div class="button-confirm-2" onclick="window.location='../index.php'">Zmieniam zdanie!</div>
        <div class="button-confirm" onclick="window.location='action/index.php?id=<?php echo $user;?>'">Usuwam!</div>
    </div>

<?php echo $footer;?>
</body>
</html>
