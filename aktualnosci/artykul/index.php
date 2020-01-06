<?php
    include_once('../../database/database.php');
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
    <meta charset="UTF-8">
    <title>Tourist Helper - Pomocnik Turysty | <?php echo $row["title"]; ?>  </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <meta name="description" content="Tourist helper - aplikacja ułatwiająca podróżowanie">
    <script type="text/javascript" src="../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="style_artykul.css">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div id="title"><a href="../../">Tourist Helper</a></div>
        <div id="topMenu">
            <button id="logButton">Zaloguj</button>
        </div>
    </header>

    <main>
        <br><br><br>
            <div class="article">
                <div class="article_title"><?php echo $row["title"]; ?></div>
                <div class="article_info">Data publikacji: <?php echo $row["pubdate"]; ?></div>
                <div class="article_info">Autor: <a href="../autor?autor=<?php echo $row["author"]; ?>"><?php echo $row["author"]; ?></a></div>
                <div class="article_info">Kategoria: <a href="../kategoria?kategoria=<?php echo $row["topic"];?>"><?php echo $row["topic"]; ?></a></div>
                <div class="article_content"> <?php echo $row["content"]; ?></div>
                <a href="../"><div class="article_button return_button">Powrót</div></a>
            </div>

        <br><br><br>
    </main>


    <footer>
        &copy; 2019 by <a id="github" target="_blank" href="http://github.com/Trevorek97">Damian Kita</a>
        <br> Engineering Thesis, Cracow University of Technology
    </footer>

</body>
</html>
