<?php
    include_once('../../database/database.php');
    include_once('../../layout.php');
    include_once('send.php');
    session_start();

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $topic = $_POST["topic"];
    $content = $_POST["content"];
    $mail = $_POST["mail"];
    $message = sendMessage($connection, $name, $surname, $mail, $topic, $content);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(25);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../tourist.js"></script>
    <script type="text/javascript" src="../script.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../style_2.css">

</head>
<body>
<?php
if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
else $sesLog = "";
echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/default.png');
?>
    <br><br><br>

   <div class="send-info">
       <div class="send-title"><?php echo $message; ?></div>
       <div class="send-return" onclick="document.location='../../index.php'">Wróć na stronę główną</div>
   </div>



    <?php echo $footer;?>
</body>
</html>