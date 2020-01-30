<?php
    include_once('../database/database.php');
    include_once('aboutus.php');
    include_once('../layout.php');
    session_start();
    $text = aboutus($connection);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Tourist Helper - Pomocnik Turysty | O nas </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <meta name="description" content="Tourist helper - aplikacja ułatwiająca podróżowanie">
    <script type="text/javascript" src="../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="style_aboutus.css">

    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">

</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../index.php', '../profile/index.php', '../login/logout.php', '../login/register.php', '../login/login.php', '../img/avatars/default.png');
    ?>

    <br><br><br>

    <div class="aboutus-container">
        <div class="aboutus-center"><?php echo $text[0];?></div>
    </div>
    <div class="aboutus-container">
        <span class="text-left"><?php echo  $text[1] . "<br><br><br><br>" . $text[2]  ?></span>
        <img class="image-right" src="../img/aboutus1.jpg">
    </div>

    <div class="aboutus-container">
        <img class="image-left" src="../img/aboutus3.jpg">
        <span class="text-right"><?php echo $text[3] . "<br><br><br>" . $text[4];?></span>
    </div>

    <div class="aboutus-container">
        <span class="aboutus-center"><?php echo $text[5];?></span>
    </div>

    <div class="aboutus-container">
        <div class="aboutus-return" onclick="document.location='../index.php'">Wróć na stronę główną</div>
    </div>

    <br><br><br>

<?php echo $footer;?>
</body>
</html>