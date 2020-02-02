<?php
    include_once ('../../database/database.php');
    include_once ('../../layout.php');
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $sql = "select photo.id as 'id', photo.photo as 'photo', location.name as 'location', photo.visibility as 'visibility' from photo, location where
            photo.location = location.id";
    $result = $connection->query($sql)  or die($connection->error);;
?>


<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(34);?>
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
        <div class='column-flex-1' style='flex:5%'><h3>ID</h3></div>
        <div class='column-flex-2' style='flex:45%'><h3>Zdjęcie</h3></div>
        <div class='column-flex-2' style='flex:30%'><h3>Lokacja</h3></div>
        <div class='column-flex-2' style='flex:7.5%'><h3>Widoczność</h3></div>
        <div class='column-flex-2' style='flex:7.5%'><h3>Usuń</h3></div>


        <?php
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            echo "<div class='column-flex-1' style='flex:5%'>" . $row["id"] . "</div>";
            echo "<div class='photo-flex' style='flex:45%'>" . $row["photo"]. "</div>";
            echo "<div class='column-flex-2' style='flex:34%'><strong>" . $row["location"] . "</strong></div>";
            if($row["visibility"] == '0') {
                echo "<div class='column-flex-2' style='flex:7.5%'>" . "<div class='button-setAdmin' onclick='window.location=\"action/index.php?reason=1&id=$id\"'>V</div>" . "</div>";
            } else {
                echo "<div class='column-flex-2' style='flex:7.5%'>" . "<div class='button-deleteUser' onclick='window.location=\"action/index.php?reason=2&id=$id\"'>X</div>" . "</div>";
            }
                echo "<div class='column-flex-2' style='flex:7.5%'>" . "<div class='button-deleteUser' onclick='window.location=\"action/index.php?reason=3&id=$id\"'>X</div>" . "</div>";
        }
        ?>
    </div>
</div>


<?php echo $footer;?>
</body>
</html>