<?php
    include_once ('../../../../database/database.php');
    include_once ('../../../../layout.php');
    include_once ('useraction.php');
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $reason = $_GET["reason"];
    $id = $_GET["id"];
    $sql = "select login from users where id = '$id'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $login = $row["login"];
    $message = useraction($connection, $id, $login, $reason);

?>


<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php if($reason=='1') { echo title(30, $login); } else if($reason=='2') { echo title(31, $login);} else if($reason=='3') {echo title(32, $login);}?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../../../style.css">
    <link rel="stylesheet" type="text/css" href="../../../style_admin.css">
</head>
<body>
<?php
if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
else $sesLog = "";
echo showHeader($sesLog, '../../../../index.php', '../../../../profile/index.php', '../../../../login/logout.php', '../../../../login/register.php', '../../../../login/login.php', '../../../../img/avatars/'.$img.'.png');
?>
<br><br><br>

<div class="admcontainer">
    <h2 class='confirm-add' style="font-size:20px"><?php echo $message; ?></h2>
    <div class="button-return" onclick="document.location='../../../index.php'">Powrót do panelu administracyjnego</div>
</div>
<?php echo $footer;?>
</body>
</html>