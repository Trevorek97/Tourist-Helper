<?php
    include_once('../../database/database.php');
    include_once('../../layout.php');
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $sql = "select value from sysinfo where name='profile-photo'";
    $result=$connection->query($sql);
    $row=$result->fetch_assoc();
    $count = $row["value"];
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(37);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../style_profile.css">

</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/'.$img.'.png');
    ?>
<br><br><br>

    <div class="profile-container">
        <div class="profile-name">Zmiana zdjęcia profilowego</div>
        <div class="button-photo" id="left"><</div>
        <div class="photo" id="photo"></div>
        <div class="button-photo" id="right">></div>
        <div class="button-confirm" id='confirm'>Wybieram!</div>
    </div>

    <script>
        let count = <?php echo json_encode($count);?>;
        let img = <?php echo json_encode($img);?>;
        let p = document.getElementById('photo');
        let photos=[];
        for(let i=0;i<count;i++) {
            photos[i]=document.createElement("img");
            photos[i].src="../../img/avatars/" + (i+1) + ".png";
        }
        p.innerHTML = "<img class='photo' src=" + photos[img-1].src +">";
        let i = img-1;
        document.getElementById('right').onclick=function() {
            document.getElementById('photo').innerHTML="<img class='photo' src=" + photos[i+1].src +">";
            i=i+1;
        };
        document.getElementById('left').onclick=function() {
            document.getElementById('photo').innerHTML="<img class='photo' src=" + photos[i-1].src +">";
            i=i-1;
        };

        document.getElementById('confirm').onclick=function() {
            window.location="action/index.php?user=" + <?php echo json_encode($sesLog);?> + "&img=" + i;
        }
    </script>

<?php echo $footer;?>
</body>
</html>
