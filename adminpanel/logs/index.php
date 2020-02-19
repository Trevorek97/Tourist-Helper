<?php
include_once ('../../database/database.php');
include_once ('../../layout.php');
include_once ("logs.php");
session_start();
include("auth.php");
if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
$sql = "select id, information, type, date from logs order by date desc";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(46);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../style_admin.css">
</head>
<body>
<?php
if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
else $sesLog = "";
echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/'.$img.'.png');
?>
<br><br><br>

<div class="admcontainer" style="width:90%">
    <div class="flex-container-2">
        <div class='column-flex-1' style='flex:10%'><h3>ID</h3></div>
        <div class='column-flex-2' style='flex:20%'><h3>Data zdarzenia</h3></div>
        <div class='column-flex-2' style='flex:20%'><h3>Typ zdarzenia</h3></div>
        <div class='column-flex-2' style='flex:50%; text-align:left'><h3>Informacja o zdarzeniu</h3></div>


        <?php
        while ($row = $result->fetch_assoc())
        {   $typenum = $row["type"];
            $typetext = setLogType($typenum);
            $id = $row["id"];
            echo "<div class='column-flex-1' style='flex:10%'>" . $row["id"] . "</div>";
            echo "<div class='column-flex-2' style='flex:20%'>" . $row["date"] . "</div>";
            echo "<div class='column-flex-2' style='flex:20%'>" . $typetext . "</div>";
            echo "<div class='column-flex-2' style='flex:50%; text-align:left'>" . $row["information"] . "</div>";
        }
        ?>
    </div>
    <div class="button-next" style="width:20%; margin: 0 auto" onclick="refresh()">Odśwież</div>
</div>
<?php echo $footer;?>
<script>
    function refresh()
    {
        window.location='index.php';
    }
</script>

</body>
</html>