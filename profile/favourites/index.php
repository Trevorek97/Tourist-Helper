<?php
    include_once('../../database/database.php');
    include_once('../../layout.php');
    session_start();
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $log = $_SESSION["login"];
    $sql0 = "select id from users where login='$log'";
    $result0=$connection->query($sql0);
    $row0 = $result0->fetch_assoc();
    $userid = $row0["id"];
    $sql = "select location.name as 'name' from location, users_favourite where user = $userid and location.id=users_favourite.location";
    $result=$connection->query($sql);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(38);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../style_profile.css">

</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/'.$img.'.png');
    ?>
<br><br><br>

    <div class="profile-container">
         <?php while($row=$result->fetch_assoc()) {
             $i=0;
             $name=$row["name"];
             echo "<div class='favourite-info'>" . $name ."</div>";

         }?>
    </div>

<?php echo $footer;?>
</body>
</html>
