<?php
include_once('../../../database/database.php');
include_once('../../../layout.php');
include('position.php');
session_start();
include("auth.php");
$id = $_GET["id"];
if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection);}
$login = $_SESSION["login"];
$sql = "select name, description from trip where id = '$id'";
$result = $connection->query($sql) or die ($connection->error);
$row = $result->fetch_assoc();
$name = $row["name"];
$description = $row["description"];
$sql2 = "select location.id as 'id', location.position as 'position', location.name as 'name', type.type as 'type', voivodeship.voivodeship as 'voivo',
        city.name as 'city' from location, type, city, voivodeship, triplocation where voivodeship.id = city.voivodeship
        and location.city = city.id and triplocation.location = location.id and location.type = type.id and triplocation.trip = '$id'";
$result2 = $connection->query($sql2) or die ($connection->error);
$i=0;
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(50, $name);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../../tourist.js"></script>
    <link rel="icon" href="../../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../../style.css">
    <link rel="stylesheet" type="text/css" href="../../style_trip.css">
    <link rel="stylesheet" type="text/css" href="../../../guide/style_guide.css">



</head>
<body>
<?php
if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
else $sesLog = "";
echo showHeader($sesLog, '../../../index.php', '../../../profile/index.php', '../../../login/logout.php', '../../../login/register.php', '../../../login/login.php', '../../../img/avatars/'.$img.'.png' );
?>
<br><br><br>
<?php //name, id, voivodeship, city, type?>
<div class="tripcontainer">
    <div class="triptitle">Podróż <?php echo $name;?></div>
    <div class="description"><b>Opis podróży -  </b><?php echo $description;?></div>
    <?php if(mysqli_num_rows($result2) > 0 ) {
    echo "<div class='triptitle'>Lokacje:</div>
    <div class='tripflex'>";
     while ($row2 = $result2->fetch_assoc()) {
        $locid = $row2["id"];
        echo "<div class='triplocations'>
                <div class='triptitle' style='font-size:16px'>" . $row2["name"] . "</div>
                <div class='tripdetails'><b>Typ: </b>" . $row2["type"] . "</div>
                <div class='tripdetails'><b>Województwo: </b>" . $row2["voivo"] . "</div>
                <div class='tripdetails'><b>Miasto: </b>" . $row2["city"] . "</div>
                <div class='tripbutton1' onclick=\"window.location='../../../guide/search/location/index.php?id=$locid'\"><b>Szczegóły</b></div>
                <div class='tripbutton2' onclick=\"window.location ='../../../mapa/index.php?location=$locid'\"><b>Zobacz na mapie</b></div>
                <div class='tripbutton3' onclick=\"window.location ='trip.php?location=$locid&trip=$id'\"><b>Usuń z podróży</b></div>
            </div>";
         $position[$i] = $row2["position"];
         $tabid[$i] = $locid;
            $i++;
     }
    echo"</div><div class='button-newtrip' onclick='window.location=\"../../../mapa/index.php?trip=$id\"'>Mapa podróży</div>";
   echo "<div class='button-yourtrip' onclick='window.location=\"../../../guide/index.php\"'>Szukaj lokacji</div></div></div>";

    } else {
        echo "<div class='triptitle'>Nie dodałeś jeszcze żadnej lokacji do tej podróży</div>";
        echo "<div class='button-yourtrip' onclick='window.location=\"../../../guide/index.php\"'>Szukaj lokacji</div></div>";
    }?>

    <!--TODO
    position.php -> w tym pliku funkcja do odczytu pozycji każdej lokacji z trip.
    Na tej podstawie znajdź i zasugeruj lokacje w pobliżu
    Wyświetl w tej stronie
    -->
<?php
    $sqldistance = "select distance from users where login = '$login'";
    $resultdistance = $connection->query($sqldistance);
    $rowdistance = $resultdistance->fetch_assoc();
    $distance = $rowdistance["distance"];
    if(mysqli_num_rows($result2) > 0 ) {
   $index= propositions($connection, $position, $tabid, $distance/111.196672);
  if(sizeof($index)>0) {
      echo "<div class='tripcontainer'>";
      echo "<div class='triptitle'>Lokacje w pobliżu wybranych:</div>";
      for ($i = 0; $i < sizeof($index); $i++) {
          $sqlproposition = $sql2 = "select location.id as 'id', location.position as 'position', location.name as 'name', type.type as 'type', voivodeship.voivodeship as 'voivo',
        city.name as 'city' from location, type, city, voivodeship where voivodeship.id = city.voivodeship
        and location.city = city.id and location.type = type.id and location.id = '$index[$i]'";
          $resultposition = $connection->query($sqlproposition) or die($connection->error);
          $rowpos = $resultposition->fetch_assoc();
          $locid = $rowpos["id"];
          echo "<div class='triplocations'>
                <div class='triptitle' style='font-size:16px'>" . $rowpos["name"] . "</div>
                <div class='tripdetails'><b>Typ: </b>" . $rowpos["type"] . "</div>
                <div class='tripdetails'><b>Województwo: </b>" . $rowpos["voivo"] . "</div>
                <div class='tripdetails'><b>Miasto: </b>" . $rowpos["city"] . "</div>
                <div class='tripbutton1' onclick=\"window.location='../../../guide/search/location/index.php?id=$locid'\"><b>Szczegóły</b></div>
                <div class='tripbutton2' onclick=\"window.location ='../../../mapa/index.php?location=$locid'\"><b>Zobacz na mapie</b></div>
                <div class='tripbutton3' onclick=\"window.location ='trip.php?location=$locid&trip=$id&reason=1'\"><b>Dodaj do podróży</b></div>
            </div>";
          if($i==11) break;
      }
      echo "</div>";
  }}

    ?>
<br><br><br><br><br><br>
    <div class="return-container">
        <div class="return" onclick="window.location='../../../index.php'">Wróć do strony głównej</div>
    </div>
<?php echo $footer;?>



</body>
</html>