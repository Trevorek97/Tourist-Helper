<?php
    include_once('../../database/database.php');
    include_once('../../layout.php');
    session_start();
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); $log = $_SESSION["login"];
        $sql0 = "select admin from users where login = '$log'";
        $result0 = $connection->query($sql0);
        $row0 = $result0->fetch_assoc();

    }
    $id = $_GET['article'];
    $sql =  "select article.author as 'author', article.pubdate as 'pubdate', article.title as 'title',
             article_topic.topic as 'topic', article.content as 'content' from article, article_topic 
             where article_topic.id = article.topic and article.id = '$id'  ";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();



    $sql3 = "select article_comment.id as 'id', users.login as 'author', article_comment.content as 'content', article_comment.pubdate as 'pubdate' from article_comment, users, article
            where article.id=article_comment.article and users.id = article_comment.author and article.id='$id'
            order by pubdate desc";
$result3 = $connection->query($sql3);
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
        echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/'.$img.'.png');
    ?>
     <br><br><br>
            <div class="article">
                <div class="article_title"><?php echo $row["title"]; ?></div>
                <div class="article_info">Data publikacji: <?php echo $row["pubdate"]; ?></div>
                <div class="article_info">Autor: <a href="../autor?autor=<?php echo $row["author"]; ?>"><?php echo $row["author"]; ?></a></div>
                <div class="article_info">Kategoria: <a href="../kategoria?kategoria=<?php echo $row["topic"];?>"><?php echo $row["topic"]; ?></a></div>
                <div class="article_content"> <?php echo $row["content"]; ?></div>

                <div class="comment-container">
                    <div class="comment-title">Komentarze</div>

                    <?php if(isset($_SESSION["login"])) {
                        echo"<div class='article-comment-3'>
                                <div class='comment-title' style='font-size:15px'>Dodaj nowy komentarz!</div>
                                <form action='action/index.php' method='post'>
                                    <textarea class='comment-new-input' name='content' cols='100' rows='5' maxlength='960' placeholder='Dodaj komentarz' required></textarea>
                                    <input type='text' style='display:none' name='user' value='$log'>
                                    <input type='text' style='display:none' name='action' value='4'>
                                    <input type='text' style='display:none' name='article' value='$id'>
                                    <br><button class='comment-new-send' type='submit'>Wyślij!</button>
                                </form>
                                </div>";
                        }else {
                            echo "<div class='comment-title' style='font-size:15px'>Zaloguj się by móc dodać komentarz!</div>";
                        } ?>

                    <?php while ($row3 = $result3->fetch_assoc()) {
                        echo "<div class='article-comment'>";
                        echo $row3["content"] . "<br><br>";
                        echo "<div class='guide-author'>Autor: " . $row3["author"] . "</div>";
                        echo "<div class='guide-pubdate'>Dodano: " . $row3["pubdate"] . "</div>";
                        $idcom = $row3["id"];

                        if(isset($_SESSION['login']) && $row0["admin"] =='1' ) {
                            echo "<br><div class='remove-button' onclick='window.location=\"action/index.php?action=1&id=$idcom&article=$id\"'>Usuń komentarz</div>";
                        }
                        if(isset($_SESSION['login'])) {
                            echo "<div class='comment-reply'>Odpowiedz</div>";
                        }
                        echo "</div>";
                        if(isset($_SESSION['login'])) {
                            echo "<div class='article-comment-2' id='article-comment-2'>
                <form action='action/index.php' method='post'>
                    <textarea class='comment-reply-input' name='content' cols='100' rows='5' maxlength='960' placeholder='Odpowiedz na komentarz' required></textarea>
                    <input type='text' style='display:none' name='id' value='$idcom'>
                    <input type='text' style='display:none' name='user' value='$log'>
                    <input type='text' style='display:none' name='action' value='3'>
                    <input type='text' style='display:none' name='article' value='$id'>
                    <br><button class='comment-reply-send' type='submit'>Wyślij!</button>
                </form>
                </div>";
                        }
                        $sql4 = "select article_subcomment.id as 'id', article_subcomment.content as 'content', users.login as 'author', article_subcomment.pubdate as 'pubdate' from article_subcomment, users, article_comment where article_subcomment.comment = article_comment.id and article_comment.id = '$idcom' and users.id = article_subcomment.author order by pubdate desc";
                        $result4 = $connection->query($sql4) or die ($connection->error);
                        while($row4=$result4->fetch_assoc()) {
                            echo "<div class='article-comment' style='width:70%; margin-right:5%'>";
                            echo $row4["content"] . "<br><br>";
                            echo "<div class='guide-author'>Autor: " . $row4["author"] . "</div>";
                            echo "<div class='guide-pubdate'>Dodano: " . $row4["pubdate"] . "</div>";
                            if(isset($_SESSION['login']) && $row0["admin"] =='1' ) {
                                $idcom2 = $row4["id"];
                                echo "<br><div class='remove-button' onclick='window.location=\"action/index.php?action=2&id=$idcom2&article=$id\"'>Usuń komentarz</div>";
                            }
                            echo "</div>";
                        }
                    }?>
                </div>
                <br>
                <a href="../"><div class="article_button return_button">Powrót</div></a>
            </div>

    <script>
        let reply = document.querySelectorAll(".comment-reply");
        let subcomment = document.querySelectorAll(".comment-reply-input");
        let subcomment2 = document.querySelectorAll(".comment-reply-send");
        let subcomment3 = document.querySelectorAll(".article-comment-2");
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
<?php echo $footer;?>
</body>
</html>
