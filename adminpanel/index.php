<?php
    include_once('../layout.php');
    include_once('../database/database.php');
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection);
    }
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(2); ?>
    <?php echo $headInfo; ?>
    <link rel="icon" href="../img/zaplanuj.jpg" type="image/x-icon"> <!--miniaturka-->
    <script type="text/javascript" src="../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="style_admin.css">

</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../index.php', '../profile/index.php', '../login/logout.php', '../login/register.php', '../login/login.php', '../img/avatars/'.$img.'.png');
    ?>
 <br><br><br>

        <div class="admcontainer">
            <div class="whatToDo">Co chcesz zrobić?</div>
            <hr>
            <table>
                <tr>
                    <td onclick="document.location='addarticle/index.php'">
                        Dodaj artykuł
                    </td>
                    <td onclick="document.location='deletearticle/index.php'">
                        Usuń artykuł
                    </td>
                </tr>
                <tr>
                    <td onclick="document.location='addlocation/index.php'">
                        Dodaj lokację
                    </td>
                    <td onclick="document.location='deletelocation/index.php'">
                        Usuń lokację
                    </td>
                </tr>
                <tr>
                    <td onclick="document.location='userquestions/index.php'">
                        Pytania użytkowników
                    </td>
                    <td onclick="document.location='users/index.php'">
                        Użytkownicy
                    </td>
                </tr>
                <tr>
                    <td onclick="document.location='addevent/index.php'">
                        Dodaj wydarzenie
                    </td>
                    <td onclick="document.location='deleteevent/index.php'">
                        Usuń wydarzenie
                    </td>
                </tr>
                <tr>
                    <td onclick="document.location='photos/index.php'">
                        Zarządzaj zdjęciami
                    </td>
                    <td onclick="document.location='logs/index.php'">
                        Zobacz logi
                    </td>
                </tr>
            </table>

        </div>
    <br><br><br>
    <div class="return-container">
        <div class="return" onclick="window.location='../index.php'">Wróć do strony głównej</div>
    </div>
    <?php echo $footer;?>
</body>
</html>
