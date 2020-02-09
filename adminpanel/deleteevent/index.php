<?php
include_once ('../../database/database.php');
include_once ('../../layout.php');
session_start();
include("auth.php");
if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }

$sql = "select event.id as 'id', event.name as 'name', location.name as 'location', event.startdate as 'startdate',
       event.enddate as'enddate' from event, location where event.location=location.id";
$result=$connection->query($sql);
?>


<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(43);?>
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
<div class="admcontainer" style="width:80%">
    <div class="flex-container-2">
        <div class='column-flex-1' style="flex: 0 0  10%"><h3>ID</h3></div>
        <div class='column-flex-2'><h3>Tytuł</h3></div>
        <div class='column-flex-2'><h3>Lokacja</h3></div>
        <div class='column-flex-2'><h3>Zaczyna się</h3></div>
        <div class='column-flex-2'><h3>Kończy się</h3></div>
        <div class='column-flex-2'><h3>Usuń</h3></div>

        <?php
        while ($row = $result->fetch_assoc())
        {
            $id = $row["id"];
            $name = $row["name"];
            $location = $row["location"];
            $startdate = date_create($row["startdate"]);
            $enddate = date_create($row["enddate"]);
            echo "<div class='column-flex-1' style='flex:0 0 10%''>" . $row["id"] . "</div>";
            echo "<div class='column-flex-2'>" . $row["name"] . "</div>";
            echo "<div class='column-flex-2'>" . $row["location"] . "</div>";
            echo "<div class='column-flex-2'>" . date_format($startdate,'d-m-Y') . "</div>";
            echo "<div class='column-flex-2'>" . date_format($enddate,'d-m-Y') . "</div>";
            echo "<div class='column-flex-2'>" . "<div class='button-delete' onclick=\"document.location='deleted/index.php?deleted=$id&name=$name&location=$location'\">X</div>" . "</div>";
        }
        ?>
    </div>
</div>

<?php echo $footer;?>
</body>
</html>