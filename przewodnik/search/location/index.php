<?php
    include_once ('../../../database/database.php');
    include_once ('../../../layout.php');
    session_start();
    $id = $_GET["id"];

    $sql1 = "select location.name as name, location.description as description, location.position as position,
        location.street as street, location.postcode as postcode, location.number as number, city.name as city,
       voivodeship.voivodeship as voivodeship, type.type as type from location, city, voivodeship, type where location.id='$id' and city.id=location.city
                and voivodeship.id=city.voivodeship and type.id = location.type";
    $result = $connection->query($sql1);
    $location = $result->fetch_assoc();

    $sql2 = "select * from photo where location='$id'";
    $result2 = $connection->query($sql2);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(15, $location["name"]);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../../tourist.js"></script>
    <link rel="icon" href="../../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../../style.css">
    <link rel="stylesheet" type="text/css" href="../../style_przewodnik.css">
</head>
<body>
<?php
    if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
    else $sesLog = "";
    echo showHeader($sesLog, '../../../index.php', '../../../profile/index.php', '../../../login/logout.php', '../../../login/register.php', '../../../login/login.php', '../../../img/avatars/default.png');
?>
    <br><br><br>

    <div class="location-container">

        <div class="location-title"><?php echo $location["name"];?></div>


        <div class="photos-container">
            <?php
            $i=0;
            while($photo = $result2->fetch_assoc()) {
                echo "<div class='photo-small'>" . $photo["photo"] . "</div>";
                $photos[$i++]=$photo["photo"];
            }
            ?>
        </div>

        <div class="guide-details">
            <div>
                <span class="details-title">Typ:</span>
                <span class="details-info"><?php echo $location["type"]; ?></span>
            </div>
            <div>
                <span class="details-title">Województwo:</span>
                <span class="details-info"><?php echo $location["voivodeship"]; ?></span>
            </div>
            <div>
                <span class="details-title">Miasto:</span>
                <span class="details-info"><?php echo $location["city"]; ?></span>
            </div>
            <div>
                <span class="details-title">Ulica:</span>
                <span class="details-info"><?php echo $location["street"] . " " . $location["number"]; ?></span>
            </div>
            <div>
                <span class="details-title">Kod pocztowy:</span>
                <span class="details-info"><?php echo $location["postcode"] ?></span>
            </div>
            <div>
                <span class="details-title">Lokalizacja:</span>
                <span class="details-info"><?php echo $location["position"] ?></span>
            </div>
        </div>

        <div class="photo-big-container">
            <span id="photo-big" class="photo-big"></span>
        </div>

        <div class="guide-description">
            <?php echo $location["description"];?>
        </div>
    </div>

    <script>
        let photosJS = <?php echo json_encode($photos); ?>;
        document.getElementById("photo-big").innerHTML=photosJS[0];
        let photos = document.querySelectorAll(".photo-small");
        for(let i=0;i<=photos.length;i++) {
            photos[i].style.filter="grayscale(1)";
            photos[i].style.backgroundColor="#292929";
            photos[i].onclick=function() {
                let  s = document.getElementById("photo-big");
                s.innerHTML=photosJS[i];
            };
            photos[i].onmouseout=function() {
                this.style.filter="grayscale(1)";
                photos[i].style.backgroundColor="#292929";
            };
            photos[i].onmouseover=function() {
              this.style.filter="grayscale(0)";
              photos[i].style.backgroundColor="#c9a904";
            };
        }
    </script>

    <?php echo $footer;?>
</body>
</html>