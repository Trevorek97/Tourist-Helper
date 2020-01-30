<?php
include_once ('../../../database/database.php');
include_once ('../../../layout.php');
session_start();
include("auth.php");

$reason = $_GET["reason"];
$id = $_GET["id"];
?>


<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(33);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../../style.css">
    <link rel="stylesheet" type="text/css" href="../../style_admin.css">
</head>
<body>
<?php
if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
else $sesLog = "";
echo showHeader($sesLog, '../../../index.php', '../../../profile/index.php', '../../../login/logout.php', '../../../login/register.php', '../../../login/login.php', '../../../img/avatars/default.png');
?>
<br><br><br>
    <div class="admcontainer">
        <?php if($reason == '1') {
            $sql = "select content from user_message where id = '$id'";
            $result= $connection->query($sql);
            $row = $result->fetch_assoc();
            echo "<div class='content'>" . $row["content"] . "</div>";
            echo "<form method='POST' style='width:auto; margin-bottom:10px' action='../index.php?answerid=$id'>";
            echo "<textarea name='answercontent' class='answer' required></textarea>";
            echo "<button type='submit' class='button-next' style='width:50%; border:none'>Dodaj!</button>";
            echo"</form>";
            echo "<div class='button-return' style='width:50%; margin: 0 auto;' onclick='window.location=\"../index.php\"'>Powrót do menu pytań</div>";

        } else if ($reason == '2') {
            $sql = "delete from user_message where id = '$id'";
            $result = $connection->query($sql);
            echo "<h2 class='confirm-add' style=\"font-size:20px\">Usunięto pytanie numer $id.</h2>
        <div class=\"button-return\" onclick=\"document.location='../index.php'\">Powrót do menu pytań</div>";
        }  else if ($reason =='3') {
            $sql = "update user_message set public = '1' where id = '$id'";
            $result = $connection->query($sql);
            echo "<h2 class='confirm-add' style=\"font-size:20px\">Pytanie $id jest publiczne.</h2>
        <div class=\"button-return\" onclick=\"document.location='../index.php'\">Powrót do menu pytań</div>";
        } else if ($reason =='4') {
            $sql = "update user_message set public = '0' where id = '$id'";
            $result = $connection->query($sql);
            echo "<h2 class='confirm-add' style=\"font-size:20px\">Pytanie $id zostało ukryte.</h2>
        <div class=\"button-return\" onclick=\"document.location='../index.php'\">Powrót do menu pytań</div>";
        } else if ($reason =='5') {
            $sql = "select content from user_message where id = '$id'";
            $result= $connection->query($sql);
            $row = $result->fetch_assoc();
            echo "<div class='content'>" . $row["content"] . "</div>";
            echo "<div class='button-return' style='width:50%; margin: 0 auto' onclick='window.location=\"../index.php\"'>Powrót do menu pytań</div>";

        }
        ?>
    </div>
<?php echo $footer;?>
</body>
</html>