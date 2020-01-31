<?php
    include_once ('../database/database.php');
    include_once ('../layout.php');
    session_start();

    $sql = "select content, answer from user_message where public = '1' order by id desc";
    $result = $connection->query($sql);
?>


<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(19);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="style_faq.css">
</head>
<body>
<?php
if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
else $sesLog = "";
echo showHeader($sesLog, '../index.php', '../profile/index.php', '../login/logout.php', '../login/register.php', '../login/login.php', '../img/avatars/default.png');
?>
<br><br><br>
        <?php while ($row = $result->fetch_assoc()) {
            echo "<div class='question-container'>";
            echo "<div class='question'>" . $row["content"] . "</div>";
            echo "<div class='answer'>" . $row["answer"] ."</div>";
            echo "</div>";
            echo "<div class='space'></div>";
        } ?>
<?php echo $footer;?>
</body>
</html>