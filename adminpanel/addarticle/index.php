<?php
    include_once ('../../database/database.php');
    include_once ('../../layout.php');
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $sql = "select id as 'id', topic as 'topic' from article_topic";
    $result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(3);?>
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

        <h2>Dodaj nowy artykuł</h2>
        <div id="tooltip" style="font-weight:600; color:whitesmoke">Jak tworzyć artykuł?</div>
        <div id="tooltip-addarticle"><?php echo $tooltip;?></div>
        <div class="flex-container" style="width:70%; margin: 0 auto">

            <div class="first-column">Tytuł</div>
            <div class="second-column"> <input type="text" name="title" placeholder="Podaj tytuł artykułu"> </div>
            <div class="first-column">Temat</div>
            <div class="second-column">
                <select style="width: 80%" name="topic" id="topicList">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $topic = $row["topic"];
                        echo "<option value=$id>" . $topic . "</option>";
                    }
                    ?>
                </select>
            </div>


            <div class="first-column">Autor</div>
            <div class="second-column"><input type="text" name="author" placeholder="Podaj autora" value="<?php echo $_SESSION["login"];?>"></div>
            <div class="first-column">Treść artykułu</div>
            <div class="second-column"><textarea name="content" rows="50" cols="50" style="width:80%"></textarea></div>
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
    <?php echo $footer;?>
</body>
</html>