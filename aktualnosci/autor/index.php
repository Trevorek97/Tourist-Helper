<?php
include_once('../../database/database.php');
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
    <meta charset="UTF-8">
    <title>Tourist Helper - Pomocnik Turysty | Artykuły autora <?php echo $author; ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <meta name="description" content="Tourist helper - aplikacja ułatwiająca podróżowanie">
    <script type="text/javascript" src="../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../style_aktualnosci.css">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div id="title"><a href="../">Tourist Helper</a></div>
    <div id="topMenu">
        <button id="logButton">Zaloguj</button>
    </div>
</header>
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
    <br><br><br>
</main>
<footer>
    &copy; 2019 by <a id="github" target="_blank" href="http://github.com/Trevorek97">Damian Kita</a>
    <br> Engineering Thesis, Cracow University of Technology
</footer>

</body>
</html>
