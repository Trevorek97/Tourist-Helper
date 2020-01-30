<?php
    include_once("../../../database/database.php");
    include_once("../../../layout.php");
    session_start();
    include("auth.php");
    $title = $_POST["title"];
    $author = $_POST["author"];
    $topic = $_POST["topic"];
    $content = $_POST["content"];
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(20);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../../tourist.js"></script>
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

    <?php
        $sql = "insert into article(topic, title, author, content) values ('$topic', '$title', '$author', '$content')";
        if($connection->query($sql) === TRUE) {
            $res = "Dodano nowy artykuł!";
        } else {
            $res = "Błąd dodawania artykułu!";
        }
    ?>

    <div class=admcontainer>
        <h2 class='confirm-add'><?php echo $res; ?></h2>
        <h2 class="confirm-add" style="font-size:30px"> <?php echo $title; ?></h2>
        <div class="button-return" onclick="document.location='../../index.php'">Wróć do panelu</div>
        <div class="button-list" onclick="document.location='../../deletearticle/index.php'">Wyświetl wszystkie artykuły</div>
        <div class="button-next" onclick="document.location='../index.php'">Dodaj kolejny artykuł</div>
    </div>

    <?php echo $footer;?>
</body>
</html>


