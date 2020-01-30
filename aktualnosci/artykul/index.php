<?php
    include_once('../../database/database.php');
    include_once('../../layout.php');
    session_start();
    $id = $_GET['article'];
    $sql =  "select article.author as 'author', article.pubdate as 'pubdate', article.title as 'title',
             article_topic.topic as 'topic', article.content as 'content' from article, article_topic 
             where article_topic.id = article.topic and article.id = '$id'  ";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(12, $row["title"]);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="style_artykul.css">

</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/default.png');
    ?>
     <br><br><br>
            <div class="article">
                <div class="article_title"><?php echo $row["title"]; ?></div>
                <div class="article_info">Data publikacji: <?php echo $row["pubdate"]; ?></div>
                <div class="article_info">Autor: <a href="../autor?autor=<?php echo $row["author"]; ?>"><?php echo $row["author"]; ?></a></div>
                <div class="article_info">Kategoria: <a href="../kategoria?kategoria=<?php echo $row["topic"];?>"><?php echo $row["topic"]; ?></a></div>
                <div class="article_content"> <?php echo $row["content"]; ?></div>
                <a href="../"><div class="article_button return_button">Powrót</div></a>
            </div>

<?php echo $footer;?>
</body>
</html>
