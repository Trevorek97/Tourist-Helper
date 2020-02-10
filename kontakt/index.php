<?php
    include_once('../database/database.php');
    include_once('../layout.php');
    session_start();
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    if(isset($_SESSION['login'])) {
        $login = $_SESSION['login'];
        $sql = "select name, surname, email from users where login='$login'";
        $result=$connection->query($sql);
        $row=$result->fetch_assoc();
        $name = $row["name"];
        $surname = $row["surname"];
        $email = $row["email"];
}
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(17);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../tourist.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <link rel="icon" href="../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="style_2.css">

</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../index.php', '../profile/index.php', '../login/logout.php', '../login/register.php', '../login/login.php', '../img/avatars/'.$img.'.png');
    ?>
        <br><br><br>
        <form action="send/index.php" method="POST">
            <h2>Napisz do nas!</h2>
            <label><b>Imię:</b><input name="name" type="text" placeholder="Podaj imię" <?php if(isset($_SESSION['login'])) echo "value='$name'";?> required></label><br>
            <label><b>Nazwisko:</b><input name="surname" type="text" placeholder="Podaj nazwisko" <?php if(isset($_SESSION['login'])) echo "value='$surname'";?> required></label><br>
            <label><b>E-mail:</b><input name="mail" type="email" placeholder="Podaj e-mail" <?php if(isset($_SESSION['login'])) echo "value='$email'";?> required></label><br>
            <label><b>Temat wiadomości:</b><br>
                <label class="radiolabel">Opinia o aplikacji<input type="radio" name="topic"  value="1" checked></label><br>
                <label class="radiolabel">Zgłoś problem<input type="radio" name="topic" value="2"></label><br>
                <label class="radiolabel">Inny<input type="radio" name="topic" value="3"></label><br>
            </label>
            <label><b>Wiadomość:</b><textarea name="content" cols="100" rows="10" maxlength="960" placeholder="Wpisz swoją wiadomość" required></textarea></label>
            <button id="submitMessage"  type="submit">Wyślij!</button>

        </form>
    <br><br><br><br>
    <div class="return-container">
        <div class="return" onclick="document.location='../index.php'">Wróć na stronę główną</div>
    </div>
    <?php echo $footer;?>
</body>
</html>