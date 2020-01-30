<?php
    include_once ('../../database/database.php');
    include_once('../../layout.php');
    session_start();
    include("auth.php");

    $sql1 = "select id as 'id', type as 'type' from type";
    $result1 = $connection->query($sql1);

    $sql2 = "select id as 'id', voivodeship as 'voivodeship' from voivodeship";
    $result2 = $connection->query($sql2);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(5);?>
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
    <form action="added/index.php" method="POST">

        <h2>Dodaj nową lokację</h2>

        <div class="flex-container">
            <div class="first-column">Link do zdjęć</div>
            <div class="second-column"> <input type="url" name="link" placeholder="Podaj link do strony"> </div>
            <div class="first-column">Rodzaj lokacji</div>
            <div class="second-column">
                <select style="width: 80%" name="type" id="typesList">
                    <?php
                    while ($row1 = $result1->fetch_assoc()) {
                        $id = $row1["id"];
                        $type = $row1["type"];
                        echo "<option value=$id>" . $type . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="first-column">Województwo</div>
            <div class="second-column">
                <select style="width:80%" name="voivodeship" id="voivodeshipsList">
                    <?php
                    while ($row2 = $result2->fetch_assoc()) {
                        $id2 = $row2["id"];
                        $voivodeship = $row2["voivodeship"];
                        echo "<option value=$id2>" . $voivodeship . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="first-column">Miejscowość</div>
            <div class="second-column"><input type="text" name="city" placeholder="Podaj miasto"></div>
            <div class="first-column">Ulica</div>
            <div class="second-column"><input type="text" name="street" placeholder="Podaj ulicę"></div>
            <div class="first-column">Numer</div>
            <div class="second-column"><input type="text" name="number" placeholder="Podaj numer"></div>
            <div class="first-column">Kod pocztowy</div>
            <div class="second-column"><input type="text" name="postcode" placeholder="Podaj kod pocztowy"></div>
            <div class="first-column">Nazwa lokacji</div>
            <div class="second-column"><input type="text" name="name" placeholder="Jak nazwiesz tę lokację?"></div>
            <div class="first-column">Współrzędne</div>
            <div class="second-column"><input type="text" name="position" placeholder="Podaj współrzędne"></div>
            <div class="first-column">Opis</div>
            <div class="second-column"><textarea name="description" rows="10" cols="50" style="width:80%"></textarea></div>
        </div>

        <br>
        <button class="submit" type="submit">Dodaj!</button>
    </form>

    <?php echo $footer;?>
</body>
</html>