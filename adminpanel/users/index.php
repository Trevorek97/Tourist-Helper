<?php
    include_once ('../../database/database.php');
    include_once ('../../layout.php');
    session_start();
    include("auth.php");

    $sql = "select login, email, name, surname, regdate, admin from users";
    $result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(28);?>
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
        echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/default.png');
    ?>
    <br><br><br>

    <div class="admcontainer" style="width:80%">
        <div class="flex-container-2">
            <div class='column-flex-1' style="flex: 0 0  10%"><h3>ID</h3></div>
            <div class='column-flex-2'><h3>Login</h3></div>
            <div class='column-flex-2'><h3>Email</h3></div>
            <div class='column-flex-2'><h3>Imię</h3></div>
            <div class='column-flex-2'><h3>Nazwisko</h3></div>
            <div class='column-flex-2'><h3>Użytkownik od</h3></div>
            <div class='column-flex-2'><h3>Usuń</h3></div>
            <div class='column-flex-2'><h3>Ban</h3></div>
            <div class='column-flex-2'><h3>Admin</h3></div>

            <?php
            while ($row = $result->fetch_assoc())
            {
                $id = $row["id"];
                $title = $row["title"];
                echo "<div class='column-flex-1' style='flex:0 0 10%''>" . $row["id"] . "</div>";
                echo "<div class='column-flex-2'>" . $row["login"] . "</div>";
                echo "<div class='column-flex-2'>" . $row["email"] . "</div>";
                echo "<div class='column-flex-2'>" . $row["name"] . "</div>";
                echo "<div class='column-flex-2'>" . $row["surname"] . "</div>";
                echo "<div class='column-flex-2'>" . $row["regdate"] . "</div>";

                echo "<div class='column-flex-2'>" . "<div class='button-delete' onclick=\"document.location='deleted/index.php?deleted=$id&title=$title'\">X</div>" . "</div>";
            }
            ?>
        </div>
    </div>
    <?php echo $footer;?>
</body>
</html>