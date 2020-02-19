<?php
include_once ('../database/database.php');
include_once ('../layout.php');
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(27);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../tourist.js"></script>
    <link rel="icon" href="../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="style_login.css">
</head>
<body>
<header>
    <div id="title"><a href="../">Tourist Helper</a></div>
    <div id="topMenu">
        <button id="logButton">Zaloguj</button>
    </div>
</header>
<br><br><br>

<?php
session_start();
if (isset($_POST['login'])){
    $login = stripslashes($_REQUEST['login']);
    $login = mysqli_real_escape_string($connection,$login);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($connection,$password);

    $query = "SELECT id FROM users WHERE login='$login'
and password='".md5($password)."'";

    $result = mysqli_query($connection,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);




    if($rows==1){
        $_SESSION['login'] = $login;
        $rowquery = $result->fetch_assoc();
        $userid = $rowquery["id"];
        $userip = $_SERVER["REMOTE_ADDR"];
        $userbrowser = $_SERVER["HTTP_USER_AGENT"];
        $sessionquery = "insert into active_session(user, ip, browser) values ('$userid', '$userip', '$userbrowser')";
        $connection->query($sessionquery) or die ($connection->error);
        header("Location: ../index.php");
    }else{
        echo "<div class='login-container'>
<div class='login-title' style='font-size:18px'>Login lub hasło niepoprawne!</div>
<a href='login.php'><div class='submit'>Zaloguj się</div></a></div>";
    }
}else{
    ?>
    <div class="login-container">
        <div class="login-title">Zaloguj się</div>
        <form action="" method="post" name="login">
            <div class="login-row">
                <div class="login-info-text">Login: </div>
                <div class="login-info-input" ><input type="text" name="login" placeholder="Podaj login" required </input></div>
                <div class="login-info-text">Hasło: </div>
                <div class="login-info-input"><input type="password" name="password" placeholder="Podaj hasło" required </input></div>
            </div>
            <input class="submit" type="submit" name="submit" value="Zaloguj!" </input>

        </form>
        <div class="login-title"  id="login-title" style="font-size:18px">Nie masz jeszcze konta? <a href='register.php' style='font-weight:600'>Zarejestruj się</a>.</div>
    </div>
<?php } ?>

<?php echo $footer;?>
</body>
</html>
