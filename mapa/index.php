<?php
    include_once('../database/database.php');
    include_once('../layout.php');
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(26);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="style_2.css">


</head>
<body>
<header>
    <div id="title"><a href="../">Tourist Helper</a></div>
    <div id="topMenu">
        <button id="logButton">Zaloguj</button>
    </div>
</header>
 <br><br><br>

    TEMPLATE

    <?php echo $footer;?>
</body>
</html>