<?php
    include_once ('../../../database/database.php');
    include_once ('../../../layout.php');
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $reason = $_GET["reason"];
    $id = $_GET["id"];
?>


<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(34);?>
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
echo showHeader($sesLog, '../../../index.php', '../../../profile/index.php', '../../../login/logout.php', '../../../login/register.php', '../../../login/login.php', '../../../img/avatars/'.$img.'.png');
?>
<br><br><br>
    <div class="admcontainer">
        <?php if($reason == '1') {
            $sql = "update photo set visibility = '1' where id = '$id'";
            $result= $connection->query($sql);
            echo "<div class='confirm-add' style=\"font-size:20px\">Zdjęcie $id jest widoczne</div>";
            echo "<div class='button-return' style='width:50%; margin: 0 auto;' onclick='window.location=\"../index.php\"'>Powrót do listy zdjęć</div>";

        } else if ($reason == '2') {
            $sql = "update photo set visibility = '0' where id = '$id'";
            $result= $connection->query($sql);
            echo "<div class='confirm-add' style=\"font-size:20px\">Zdjęcie $id zostało ukryte</div>";
            echo "<div class='button-return' style='width:50%; margin: 0 auto;' onclick='window.location=\"../index.php\"'>Powrót do listy zdjęć</div>";

        }  else if ($reason =='3') {
            $sql = "delete from photo where id = '$id'";
            $result = $connection->query($sql);
            echo "<h2 class='confirm-add' style=\"font-size:20px\">Zdjęcie $id zostało usunięte.</h2>";
            echo "<div class='button-return' style='width:50%; margin: 0 auto;' onclick='window.location=\"../index.php\"'>Powrót do listy zdjęć</div>";
        }
        ?>
    </div>
<?php echo $footer;?>
</body>
</html>