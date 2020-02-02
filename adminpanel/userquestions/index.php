<?php
    include_once ('../../database/database.php');
    include_once ('../../layout.php');
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    if(isset($_GET['answerid']) && isset($_POST['answercontent'])) {
    $answercontent =  $_POST['answercontent'];
    $answerid = $_GET['answerid'];
    $sql3 = "update user_message set answer = '$answercontent' where id = '$answerid'";
    $result3 = $connection->query($sql3);
    }
    $sql = "select id, name, surname, mail, content, answer, topic, public from user_message";
    $result = $connection->query($sql)  or die($connection->error);;
    $sql2 = "select id, topic from message_topic";
    $result2 = $connection->query($sql2)  or die($connection->error);;
    $i=0;
    $topic=[];
    while ($row2=$result2->fetch_assoc()) {
        $topic[$i++]=$row2["topic"];
    }


?>


<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(33);?>
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
        <div class='column-flex-1' style='flex:5%'><h3>ID</h3></div>
        <div class='column-flex-2' style='flex:16%'><h3>Temat</h3></div>
        <div class='column-flex-2' style='flex:15%'><h3>Imię</h3></div>
        <div class='column-flex-2' style='flex:15%'><h3>Nazwisko</h3></div>
        <div class='column-flex-2' style='flex:15%'><h3>Email</h3></div>
        <div class='column-flex-2' style='flex:7.5%'><h3>Czytaj</h3></div>
        <div class='column-flex-2' style='flex:7.5%'><h3>Odpowiedz</h3></div>
        <div class='column-flex-2' style='flex:7.5%'><h3>Usuń</h3></div>
        <div class='column-flex-2' style='flex:7.5%'><h3>Publikuj</h3></div>

        <?php
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            echo "<div class='column-flex-1' style='flex:5%'>" . $row["id"] . "</div>";
            echo "<div class='column-flex-2' style='flex:16%'>" . $topic[$row["topic"]-1] . "</div>";
            echo "<div class='column-flex-2' style='flex:15%'>" . $row["name"] . "</div>";
            echo "<div class='column-flex-2' style='flex:15%'>" . $row["surname"] . "</div>";
            echo "<div class='column-flex-2' style='flex:15%'>" . $row["mail"] . "</div>";
            echo "<div class='column-flex-2' style='flex:7.5%'>" . "<div class='button-read' onclick='window.location=\"answer/index.php?reason=5&id=$id\"'>V</div>" . "</div>";
            if($row["answer"] == '') {
                echo "<div class='column-flex-2' style='flex:7.5%'>" . "<div class='button-public' onclick='window.location=\"answer/index.php?reason=1&id=$id\"'>V</div>" . "</div>";
            } else {
                echo "<div class='column-flex-2' style='flex:7.5%'>-</div>";
            }
            echo "<div class='column-flex-2' style='flex:7.5%'>" . "<div class='button-deleteUser' onclick='window.location=\"answer/index.php?reason=2&id=$id\"'>X</div>" . "</div>";
            if($row["answer"] != '' && $row["public"] == '0') {
                echo "<div class='column-flex-2' style='flex:7.5%'>" . "<div class='button-setAdmin' onclick='window.location=\"answer/index.php?reason=3&id=$id\"'>V</div>" . "</div>";
            } else if ($row["answer"] != '' && $row["public"] == '1') {
                echo "<div class='column-flex-2' style='flex:7.5%'>" . "<div class='button-deleteUser' onclick='window.location=\"answer/index.php?reason=4&id=$id\"'>X</div>" . "</div>";
            } else if ($row["answer"] == '') {
                echo "<div class='column-flex-2' style='flex:7.5%'>-</div>";
            }
        }
        ?>
    </div>
</div>
<?php echo $footer;?>
</body>
</html>