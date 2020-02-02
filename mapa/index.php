<?php
    include_once ('../database/database.php');
    include_once('../layout.php');
    include_once('functions.php');
    session_start();
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }


    $i=0;
    $sql = "select id, position, name from location";
    $pos=[];
    $name=[];
    $result=$connection->query($sql);
    while ($row =$result->fetch_assoc()) {
        $pos[$i] = $row["position"];
        $name[$i] =$row["name"];
        $id[$i] = $row["id"];
        $tab[$i] = readPositions($pos[$i]);
        $lat[$i] = $tab[$i][0];
        $lon[$i] = $tab[$i][1];
        $i++;
    }
    if(isset($_GET["location"])) {
        $startid = $_GET["location"];
    } else {
        $startid =  $row["id"];
        }
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(26);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../tourist.js"></script>
    <link rel="icon" href="../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../index.php', '../profile/index.php', '../login/logout.php', '../login/register.php', '../login/login.php', '../img/avatars/'.$img.'.png');
    ?>
    <br><br><br>

    <div class="map-container">
        <div id="Map" class="map"></div>
    </div>
    <div class="return-container">
        <div class="return" onclick="window.location='../index.php'">Wróć do strony głównej</div>
    </div>
    <script src="OpenLayers.js"></script>
    <script>
        let zoom = 18;
        let fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
        let toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
        let markers = new OpenLayers.Layer.Markers( "Markers" );
        let position=[];
        let lat = <?php echo json_encode($lat);?>;
        let lon = <?php echo json_encode($lon);?>;
        let name = <?php echo json_encode($name);?>;
        let id = <?php echo json_encode($id);?>;
        for(let i=0;i<lat.length;i++) {
            position[i] = new OpenLayers.LonLat(lon[i], lat[i]).transform( fromProjection, toProjection);
            markers.addMarker(new OpenLayers.Marker(position[i]));

        }
        map = new OpenLayers.Map("Map");
        let mapnik = new OpenLayers.Layer.OSM();
        map.addLayer(mapnik);
        map.addLayer(markers);
        let start = <?php echo json_encode($startid);?>;
        for(let j=0;j<lat.length;j++) {
            if(start == id[j]) {
                start = j;
                break;
            }
            if(j==lat.length-1) {
                start = j;
            }
        }
        map.setCenter(position[start], zoom);

        console.log('My object: ', markers);
    </script>

    <script>
    let l = document.querySelectorAll(".olAlphaImg");
        for(let i=0;i<l.length;i++) {
            l[i].onclick = function() {
              if(confirm(name[i] + "\nKliknij 'OK' by otworzyć szczegóły lokacji!")) {
                  window.location="../przewodnik/search/location/index.php?id=" + id[i];
              }
              l[i].onmouseover = function() {
                  this.style.cursor="pointer";
              }
            };
        }
        document.getElementById("OpenLayers_Control_Attribution_21").style.display="none";
    </script>

<?php echo $footer;?>
</body>
</html>