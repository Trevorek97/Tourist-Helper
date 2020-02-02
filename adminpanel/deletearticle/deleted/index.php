<?php
    include_once('../../../database/database.php');
    include_once('../../../layout.php');
    include_once('delete.php');
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $id = $_GET["deleted"];
    $title = $_GET["title"];
    $message = deleteArticle($connection, $id);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(21);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../../tourist.js"></script>
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

    <?php echo $id; ?>

    <div class=admcontainer>
        <h2 class='confirm-add'><?php echo $message; ?></h2>
        <h2 class="confirm-add" style="font-size:30px"> <?php echo $title; ?></h2>
        <div class="button-return" onclick="document.location='../../index.php'">Wróć do panelu</div>
        <div class="button-next" onclick="document.location='../index.php'">Usuń kolejny artykuł</div>
    </div>

    <?php echo $footer;?>
</body>
</html>


