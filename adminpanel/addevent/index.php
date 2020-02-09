<?php
    include_once ('../../database/database.php');
    include_once ('../../layout.php');
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $sql = "select id as 'id', name as 'name' from location";
    $result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(44);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../tourist.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../style_admin.css">
</head>
<body>
<script>test();</script>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/'.$img.'.png');
    ?>
    <br><br><br>

    <form action="added/index.php" method="POST">

        <h2>Dodaj nowe wydarzenie</h2>
        <div id="tooltip" style="font-weight:600; color:whitesmoke">Jak tworzyć opis wydarzenia?</div>
        <div id="tooltip-addarticle"><?php echo $tooltip;?></div>
        <div class="flex-container" style="width:70%; margin: 0 auto">

            <div class="first-column">Nazwa</div>
            <div class="second-column"> <input type="text" name="name" placeholder="Podaj nazwę wydarzenia" required> </div>
            <div class="first-column">Miejsce</div>
            <div class="second-column">
                <select style="width: 80%" name="location" id="locationlist" required>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $name = $row["name"];
                        echo "<option value=$id>" . $name . "</option>";
                    }
                    ?>
                </select>
            </div>


            <div class="first-column">Data początkowa</div>
            <div class="second-column"><input type="date" id="start" oninput="checkdates('start', 'end')" name="startdate" placeholder="Początek wydarzenia" required></div>

            <div class="first-column">Data końcowa</div>
            <div class="second-column"><input type="date" id="end" oninput="checkdates('start', 'end')" name="enddate" placeholder="Początek wydarzenia" required></div>
            <div class="info" id="info" style="color:red"></div>
            <div class="first-column">Opis wydarzenia</div>
            <div class="second-column"><textarea name="description" rows="50" cols="50" style="width:80%" required></textarea></div>
        </div>
        <br>
        <button class="submit" type="submit">Dodaj!</button>
    </form>


<script>

    function showTooltip(e)
    {
        var x= document.getElementById("tooltip-addarticle");
        x.style.display="block";
        x.style.left = e.clientX  + 10 + "px";
        x.style.top = e.clientY + 10 + "px";
    }

    function hideTooltip(e)
    {
        var x = document.getElementById("tooltip-addarticle");
        x.style.display="none";
    }

    window.onload=function()
    {
        var tmp = document.getElementById("tooltip");
        tmp.onmousemove=showTooltip;
        tmp.onmouseout=hideTooltip;
    };
</script>
<script>
    function checkdates(start,end) {
        let startdate = document.getElementById(start);
        let enddate = document.getElementById(end);
        let s = document.getElementById("info");
        enddate.oninput=function() {
          if(startdate.value>enddate.value) {
              s.style.display="inherit";
              s.innerHTML = "Data końcowa musi być większa niż początkowa!";
          } else {
              s.style.display="none";
          }

        };
        startdate.oninput=function() {
            if(startdate.value>enddate.value) {
                s.style.display="inherit";
                s.innerHTML = "Data początkowa musi być większa niż początkowa!";
            } else {
                s.style.display="none";
            }

        };
    }
</script>
    <?php echo $footer;?>
</body>
</html>