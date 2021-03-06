<?php
    include_once ('../../../database/database.php');
    include_once ('../../../layout.php');
    session_start();
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $id = $_GET["id"];
    if(isset($_SESSION['login'])) $log = $_SESSION['login'];
    else $log = "";

    $sql0 = "select admin from users where login = '$log'";
    $result0 = $connection->query($sql0);
    $row0 = $result0->fetch_assoc();

    $sql1 = "select location.name as name, location.description as description, location.position as position,
        location.street as street, location.postcode as postcode, location.number as number, city.name as city,
       voivodeship.voivodeship as voivodeship, type.type as type from location, city, voivodeship, type where location.id='$id' and city.id=location.city
                and voivodeship.id=city.voivodeship and type.id = location.type";
    $result = $connection->query($sql1);
    $location = $result->fetch_assoc();

    $sql2 = "select * from photo where location='$id' and visibility='1'";
    $result2 = $connection->query($sql2);

    $sql3 = "select location_comment.id as 'id', users.login as 'author', location_comment.content as 'content', location_comment.pubdate as 'pubdate' from location_comment, users, location
            where location.id=location_comment.location and users.id = location_comment.author and location.id='$id'
            order by pubdate desc";
    $result3 = $connection->query($sql3);

    $sqlrate = "select rate from location_rate where location='$id'";
    $resultrate=$connection->query($sqlrate);
    $sum=0;
    $elements=0;
    $rowcount=mysqli_num_rows($resultrate);
    while($rowrate=$resultrate->fetch_assoc()) {
        $elements++;
        $sum=$sum+$rowrate["rate"];
    }
    if($rowcount!='0') {
        $avgrate = round($sum/$elements,2) . "/5    (" . $elements . " ocen)";
    }
    else {
        $avgrate ="Nie znaleziono ocen tej lokacji!";
    }

    $sql6 = "select users.login, location_rate.location from location_rate, users where users.id=location_rate.author and location_rate.location='$id' and users.login='$log'";
    $result6=$connection->query($sql6);

    $sql7 = "select * from users, users_favourite where users_favourite.location='$id' and users.id=users_favourite.user and users.login='$log'";
    $result7=$connection->query($sql7);

    $sql8 = "select event.id as 'idevent', event.name as 'name', event.startdate as 'startdate', event.enddate as 'enddate' from event, location
             where location.id=event.location and event.location='$id' and event.enddate > current_date";
    $result8 = $connection->query($sql8);
    ?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(15, $location["name"]);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../../tourist.js"></script>
    <link rel="icon" href="../../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../../style.css">
    <link rel="stylesheet" type="text/css" href="../../style_guide.css">
</head>
<body>
<?php

    echo showHeader($log, '../../../index.php', '../../../profile/index.php', '../../../login/logout.php', '../../../login/register.php', '../../../login/login.php', '../../../img/avatars/'.$img.'.png');
?>
    <br><br><br>

    <div class="location-container">

        <div class="location-title"><?php echo $location["name"];?></div>




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
        </div>

        <div class="photos-container">
            <?php
            $i=0;
            while($photo = $result2->fetch_assoc()) {
                echo "<div class='photo-small'>" . $photo["photo"] . "</div>";
                $photos[$i++]=$photo["photo"];
            }
            ?>
        </div>


        <span class="photobutton" id="photobutton">Pokaż kolejne zdjęcie</span>

        <div class="photo-big-container">
            <span id="photo-big" class="photo-big"></span>
        </div>


        <div class="guide-description">
            <?php echo $location["description"];?>
        </div>
            <?php
            echo "<div class='guide-comment-container'>";
                if($result8->num_rows > 0 && isset($_SESSION["login"])) {
                    echo "<div class='guide-comment-title'>Nadchodzące wydarzenia:</div>";
                    while ($row8 = $result8->fetch_assoc()) {
                        $startdate = date_create($row8["startdate"]);
                        $enddate = date_create($row8["enddate"]);
                        $eventid=$row8["idevent"];
                        echo "<div class='event' onclick='window.location=\"../../../events/searchevent/event/index.php?id=$eventid\"'>";
                        echo $row8["name"] . " | Zaczyna się: " . date_format($startdate, 'd-m-Y') . " | Kończy się: " . date_format($enddate, 'd-m-Y');
                        echo "</div>";
                    }
                } else if ($result8->num_rows == 0 && isset($_SESSION["login"])){
                    echo "<div class='guide-comment-title'>Brak nadchodzących wydarzeń w tej lokacji!</div>";
                } else {
                    echo "<div class='guide-comment-title'>Zaloguj się, by zobaczyć nadchodzące wydarzenia w tej lokacji!</div>";
                }
            echo "</div>"; ?>


        <?php if(isset($_SESSION["login"])) {
            if(mysqli_num_rows($result7)==0) {
                echo "<div class='guide-favourite' onclick='window.location=\"action/index.php?action=6&location=$id&user=$log\"'>Dodaj do ulubionych!</div>";
                } else {
                echo "<div class='guide-favourite' onclick='window.location=\"action/index.php?action=7&location=$id&user=$log\"'>Usuń z ulubionych!</div>";
                }
            }
            ?>
        <div class='guide-map' onclick='window.location="../../../mapa/index.php?location=<?php echo $id;?>"'>Zobacz na mapie!</div>

        <?php if(isset($_SESSION["login"])) {
            $sqltrip = "select trip.id as 'id', trip.name as 'name' from trip, users where users.login = '$log' and users.id = trip.user";
            $resulttrip = $connection->query($sqltrip);
            if (mysqli_num_rows($resulttrip) > 0) {
                echo "<div class='guide-comment-container'>";
                echo "<div class='guide-comment-title'>Dodaj lokację do swojej podroży!</div>";
                echo "<form id='trips' method='post' action='trip.php?location=$id' class='trip-form'>";
                echo "<select name='trip' id='trip-select' class='trip-select'>";
                $tripcounter=0;
                while ($rowtrip = $resulttrip->fetch_assoc()) {
                    $rid = $rowtrip["id"];
                    $rname = $rowtrip["name"];
                    $sqltrip2 = "select * from triplocation where location = '$id' and trip = '$rid'";
                    $resulttrip2 = $connection->query($sqltrip2);
                    if(mysqli_num_rows($resulttrip2) == 0) {
                        $tripcounter++;
                        echo "<option value=$rid>" . $rname . "</option>";
                    }
                }
                echo "</select>";
                echo "<br>";
                echo "<button class='guide-newtrip' id='tripbutton' type='submit'>Dodaj do podróży!</button>";
                echo "</form>";
                echo "<br><div class='guide-newtrip' onclick=\"window.location='../../../trip/newtrip'\">Utwórz nową podróż</div>";
                echo"</div>";

            } else {
                echo "<div class='guide-comment-container'>";
                echo "<div class='guide-comment-title'>Utwórz nową podróż, by móc dodawać do niej lokacje!</div>";
                echo "<div class='guide-newtrip' onclick=\"window.location='../../../trip/newtrip'\">Dodaj podróż</div>";
                echo "</div>";

            }
        }
        ?>

        <div class="guide-comment-container">
            <div class="guide-comment-title">Oceny</div>
            <?php echo "<div class='guide-rate'>$avgrate</div>";
            if(!isset($_SESSION["login"])) {
                echo"<div class='guide-comment-title'  style='font-size:15px'>Zaloguj się by dodać ocenę!</div>";
            } else {
                if(mysqli_num_rows($result6)=='0') {
                    echo "<div class='guide-rate' >
                        <span id='stars'>
                        <img class='star' id='star' src='../../../img/inne/star.png'>
                        <img class='star' id='star' src='../../../img/inne/star.png'>
                        <img class='star' id='star' src='../../../img/inne/star.png'>
                        <img class='star' id='star' src='../../../img/inne/star.png'>
                        <img class='star' id='star' src='../../../img/inne/star.png'>
                        </span>
                        </div>";
                } else {
                    echo"<div class='guide-comment-title'  style='font-size:15px'>Wystawiłeś już ocenę do tej lokacji!</div>";

                }
            }
            ?>
        </div>


        <div class="guide-comment-container">
            <div class="guide-comment-title">Komentarze</div>
            <?php
            if(isset($_SESSION["login"])) {
                echo"<div class='guide-comment-3'>
                <div class='guide-comment-title' style='font-size:15px'>Dodaj nowy komentarz!</div>
                    <form action='action/index.php' method='post'>
                        <textarea class='comment-new-input' name='content' cols='100' rows='5' maxlength='960' placeholder='Dodaj komentarz' required></textarea>
                        <input type='text' style='display:none' name='user' value='$log'>
                        <input type='text' style='display:none' name='action' value='4'>
                        <input type='text' style='display:none' name='location' value='$id'>
                        <br><button class='comment-new-send' type='submit'>Wyślij!</button>
                    </form>
                </div>";
            }else {
                echo "<div class='guide-comment-title' style='font-size:15px'>Zaloguj się by móc dodać komentarz!</div>";
            }


            ?>
            <?php while ($row3 = $result3->fetch_assoc()) {
               echo "<div class='guide-comment'>";
                    echo $row3["content"] . "<br><br>";
                    echo "<div class='guide-author'>Autor: " . $row3["author"] . "</div>";
                    echo "<div class='guide-pubdate'>Dodano: " . $row3["pubdate"] . "</div>";
                $idcom = $row3["id"];

                if(isset($_SESSION['login']) && $row0["admin"] =='1' ) {
                        echo "<br><div class='remove-button' onclick='window.location=\"action/index.php?action=1&id=$idcom&location=$id\"'>Usuń komentarz</div>";
                    }
                if(isset($_SESSION['login'])) {
                    echo "<div class='comment-reply'>Odpowiedz</div>";
                }
                    echo "</div>";
                if(isset($_SESSION['login'])) {
                echo "<div class='guide-comment-2' id='guide-comment-2'>
                <form action='action/index.php' method='post'>
                    <textarea class='comment-reply-input' name='content' cols='100' rows='5' maxlength='960' placeholder='Odpowiedz na komentarz' required></textarea>
                    <input type='text' style='display:none' name='id' value='$idcom'>
                    <input type='text' style='display:none' name='user' value='$log'>
                    <input type='text' style='display:none' name='action' value='3'>
                    <input type='text' style='display:none' name='location' value='$id'>
                    <br><button class='comment-reply-send' type='submit'>Wyślij!</button>
                </form>
                </div>";
                }
                    $sql4 = "select location_subcomment.id as 'id', location_subcomment.content as 'content', users.login as 'author', location_subcomment.pubdate as 'pubdate' from location_subcomment, users, location_comment where location_subcomment.comment = location_comment.id and location_comment.id = '$idcom' and users.id = location_subcomment.author order by pubdate desc";
                    $result4 = $connection->query($sql4) or die ($connection->error);
                    while($row4=$result4->fetch_assoc()) {
                        echo "<div class='guide-comment' style='width:70%; margin-right:5%'>";
                    echo $row4["content"] . "<br><br>";
                    echo "<div class='guide-author'>Autor: " . $row4["author"] . "</div>";
                    echo "<div class='guide-pubdate'>Dodano: " . $row4["pubdate"] . "</div>";
                    if(isset($_SESSION['login']) && $row0["admin"] =='1' ) {
                        $idcom2 = $row4["id"];
                        echo "<br><div class='remove-button' onclick='window.location=\"action/index.php?action=2&id=$idcom2&location=$id\"'>Usuń komentarz</div>";
                    }
               echo "</div>";
                    }
            }?>

        </div>
    </div>
<br><br><br><br><br>

        <script>
            let reply = document.querySelectorAll(".comment-reply");
            let subcomment = document.querySelectorAll(".comment-reply-input");
            let subcomment2 = document.querySelectorAll(".comment-reply-send");
            let subcomment3 = document.querySelectorAll(".guide-comment-2");
            for(let i=0;i<reply.length;i++) {
                reply[i].onclick=function() {
                    if(subcomment[i].style.display==="inherit" && subcomment2[i].style.display==="inherit" && subcomment3[i].style.display==="inherit" ) {
                        subcomment[i].style.display="none";
                        subcomment2[i].style.display="none";
                        subcomment3[i].style.display="none";

                    }
                    else {
                        subcomment[i].style.display="inherit";
                        subcomment2[i].style.display="inherit";
                        subcomment3[i].style.display="inherit";
                    }

                };
        }
    </script>
<script>
    let rate = document.querySelectorAll("#star");
    for(let i=0;i<5;i++) {
        rate[i].style.filter="grayscale(1)";
        rate[i].onmouseover = function() {
          for(let j=0;j<=i;j++) {
              rate[j].style.filter = "grayscale(0)";
          }
        };
        rate[i].onmouseout = function() {
                rate[i].style.filter="grayscale(1)";
        };
        rate[i].onclick = function() {
            let user = <?php echo json_encode($log);?>;
            let location = <?php echo json_encode($id);?>;
            window.location="action/index.php?action=5&rate=" + (i+1) + "&user=" + user + "&location=" + location;
        };

        let stars = document.getElementById("stars").onmouseout=function() {
          for(let i=0;i<5;i++) {
              rate[i].style.filter="grayscale(1)";
          }
        };
    }


</script>
<script>

    let photosJS = <?php echo json_encode($photos); ?>;
    let photos = document.querySelectorAll(".photo-small");
    let len = photos.length;
    let tmp=1;
    document.getElementById('photo-big').innerHTML=photosJS[0];
    document.getElementById('photobutton').onclick=function() {
        if(tmp==len) tmp=0;
        document.getElementById('photo-big').innerHTML=photosJS[tmp];
        tmp=tmp+1;
        if(tmp==len) tmp=0;
    };
</script>
<script>
    var tripcounter = <?php echo json_encode($tripcounter);?>;
    if(tripcounter == 0) {
        document.getElementById('trips').style.display="none";
    }
</script>

<div class="return-container">
    <div class="return" onclick="window.location='../../../index.php'">Wróć do strony głównej</div>
</div>
    <?php echo $footer;?>
</body>
</html>