<?php
    include_once ("../../database/database.php");
    include_once ("../../layout.php");
    include_once ('search.php');
    session_start();
    $voivodeship=$_POST["voivodeship-guide"];
    $type=$_POST["type-guide"];
    $city=$_POST["city-guide"];
    $name=$_POST["name-guide"];
    $searchResults = searchGuide($voivodeship, $city, $name, $type, $connection);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(14);?>
    <?php echo $headInfo;?>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <script type="text/javascript" src="../../tourist.js"></script>
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../style_przewodnik.css">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/default.png');
    ?>
    <br><br><br>
        <div class="search-container" id="search-container-th">
            <div class='search-b'>Zdjęcie</div>
            <div class='search-b'>Rodzaj</div>
            <div class='search-b'>Nazwa</div>
            <div class='search-b'>Miasto</div>
            <div class='search-b'>Województwo</div>
        </div>
        <?php
            for($i=0;$i<sizeof($searchResults);$i++) {
                $sql = "select photo.photo as 'photo', type.type as 'type', location.name as 'name', city.name as 'city',
                        voivodeship.voivodeship as 'voivodeship' from location, photo, type, city, voivodeship
                        where photo.location = location.id and location.id = '$searchResults[$i]'
                        and type.id = location.type and city.id = location.city and city.voivodeship = voivodeship.id limit 1";
                $result = $connection->query($sql);
                $row = $result->fetch_assoc();
                echo "<a href='location?id=$searchResults[$i]'><div class='search-container'> ";
                    echo "<div class='search-photo'>" . $row["photo"] . "</div>";
                    echo "<div class='search-b'>" . $row["type"] . "</div>";
                    echo "<div class='search-b'>" . $row["name"] . "</div>";
                    echo "<div class='search-b'>" . $row["city"] . "</div>";
                    echo "<div class='search-b'>" . $row["voivodeship"] . "</div>";
                echo "</div></a>";
            }
        ?>

    <?php echo $footer;?>
</body>
</html>