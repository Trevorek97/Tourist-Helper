<?php
    include_once('../../database/database.php');
    include_once('../../layout.php');
    session_start();
    $author = $_GET["autor"];
    $sql =  "select article.id as 'id', article.author as 'author', article.pubdate as 'pubdate',
                 article.title as 'title', article_topic.topic as 'topic', article.content as 'content'
                 from article, article_topic where article_topic.id = article.topic 
                 and author='$author' order by pubdate desc";
    $result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(11, $author);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../style_aktualnosci.css">

</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/default.png');
    ?>
<main>
    <br><br><br>
    <span class="article_info">Artykuły autorstwa <?php echo $author; ?></span>
    <?php
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $topic=$row["topic"];
            echo "<div class='article'>";
            echo "<div class='article_title'>" . $row["title"] . "</div>";
            echo "<span class='article-topic'><a href='../kategoria?kategoria=$topic'>" . $row["topic"] . "</a></span>" .
                "<span class='article_pubdate'>" . "Data publikacji: " . $row["pubdate"] . "</span>";
            if(strlen($row["content"]) > 523) {
                echo "<div class='article_content'>" . substr($row["content"], 0, 523) . '...' . "</div>";
            }
            else {
                echo "<div class='article_content'>" . substr($row["content"], 0, 523) . "</div>";
            }
            $id = $row["id"];
            echo "<a href='../artykul?article=$id'><div class='article-button'>Czytaj więcej!</div></a>";
            echo "<div class='article_author'>" . "Autor: " . $row["author"] . "</div>";
            echo "</div><br>";
        }
    }
    ?>

<?php echo $footer;?>
</body>
</html>
