<?php
    include_once ('../database/database.php');
    include_once ('../layout.php');
    session_start();
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $sqlVoivodeship = "select * from voivodeship";
    $resultVoivodeship = $connection->query($sqlVoivodeship);

    $sqlType = "select * from type";
    $resultType = $connection->query($sqlType);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(13);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../tourist.js"></script>
    <link rel="icon" href="../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="style_guide.css">
</head>
<body>
<?php
    if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../index.php', '../profile/index.php', '../login/logout.php', '../login/register.php', '../login/login.php', '../img/avatars/'.$img.'.png');
    ?>
    <br><br><br>

    <form action="search/index.php" method="POST" class="guide-container">
        <div class="guide-title">Czego szukasz?</div>

            <div class="first-column">Rodzaj lokacji:</div>
            <div class="second-column">
                <select name="type-guide">
                    <?php
                        echo "<option value=0></option>";
                        while ($row = $resultType->fetch_assoc()) {
                            $idType = $row["id"];
                            $type = $row["type"];
                            echo "<option value=$idType>" . $type . "</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="first-column">Województwo:</div>
            <div class="second-column">
                <select name="voivodeship-guide">
                    <?php
                        echo "<option value=0></option>";
                        while ($row = $resultVoivodeship->fetch_assoc()) {
                            $idVoivodeship = $row["id"];
                            $voivodeship = $row["voivodeship"];
                            echo "<option value=$idVoivodeship>" . $voivodeship . "</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="first-column">Miasto:</div>
            <div class="second-column">
                <input type="text" name="city-guide" placeholder="Podaj miasto:">
            </div>
            <div class="guide-hr"></div>
            <div class="first-column">Wyszukiwanie według nazwy:</div>
            <div class="second-column">
                <input type="text" name="name-guide" placeholder="Podaj nazwę lub fragment nazwy:">
            </div>

        <button type='submit' class="guide-button">Szukaj!</button>

    </form>
<br><br><br>
<div class="return-container">
    <div class="return" onclick="window.location='../index.php'">Wróć do strony głównej</div>
</div>
    <?php echo $footer;?>
</body>
</html>