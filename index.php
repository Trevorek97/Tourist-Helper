<?php
    include_once('database/database.php');
    include_once('layout.php');
    session_start();

    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection);}
    $status=0;
    if(isset($_SESSION['login'])) {
        $status=2;
        $log = $_SESSION['login'];
        $sql = "select admin from users where login ='$log'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        if($row["admin"] =='1') $status=1;
    }
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(24);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="tourist.js"></script>
    <link rel="icon" href="img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, 'index.php', 'profile/index.php', 'login/logout.php', 'login/register.php', 'login/login.php', 'img/avatars/'.$img.'.png' );
    ?>

    <div id="parallelogram"></div>
        <br><br>
<div class="test">
        <div class="imgcontainer">
            <img class="imgmenu" src="img/aktualnosci.jpg" alt="Aktualności">
            <div class="imgtext">Aktualności</div>
        </div>

        <?php if(isset($_SESSION["login"]))  {
            echo"<div class='imgcontainer'>
                    <img class='imgmenu' src='img/wydarzenia.jpg' alt='Wydarzenia'>
                    <div class='imgtext'>Nadchodzące wydarzenia</div>
                 </div>"; } ?>

        <div class="imgcontainer">
            <img class="imgmenu" src="img/przewodnik.jpg" alt="Przewodnik">
            <div class="imgtext">Przewodnik</div>
        </div>

        <?php if(isset($_SESSION['login'])) {
            echo "<div class=\"imgcontainer\">
                    <img class=\"imgmenu\" src=\"img/zaplanuj.jpg\" alt=\"Zaplanuj!\">
                    <div class=\"imgtext\">Zaplanuj!</div>
                  </div>"; } ?>


        <div class="imgcontainer">
            <img class="imgmenu" src="img/mapa.jpg" alt="Mapa">
            <div class="imgtext">Mapa</div>
        </div>

        <div class="imgcontainer">
            <img class="imgmenu" src="img/o%20nas.jpg" alt="O nas">
            <div class="imgtext">O nas</div>
        </div>

        <div class="imgcontainer">
            <img class="imgmenu" src="img/kontakt.jpg" alt="Kontakt">
            <div class="imgtext">Kontakt</div>
        </div>

        <div class="imgcontainer">
            <img  class="imgmenu" src="img/faq.jpg" alt="FAQ">
            <div class="imgtext">Pytania i odpowiedzi</div>
        </div>

        <?php if(isset($_SESSION['login']) && $row["admin"] == '1') {
            echo "<div class='imgcontainer'>
                       <img class='imgmenu' src='img/adminpanel.jpg' alt='ADMIN'>
                       <div class='imgtext'>Panel administracyjny</div>
                  </div>"; } ?>
</div>

    <?php echo $footer;?>


    <script>
        setTimeout(showParallelogramText(), 990);
        mouseOnMenu(<?php echo json_encode($status);?>);
    </script>

</body>
</html>