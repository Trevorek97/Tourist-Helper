<?php
    include_once('../../database/database.php');
    include_once('../../layout.php');
    session_start();
    include("auth.php");
    if(isset($_SESSION["login"])) { $img=profilePhoto($_SESSION["login"], $connection); }
    $log = $_SESSION["login"];
    $sql = "select * from users where login = '$log'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $name1 = $row["name"];
    $surname1 = $row["surname"];
    $email1 = $row["email"];
    $login1 = $row["login"];
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo title(36, $login1);?>
    <?php echo $headInfo;?>
    <script type="text/javascript" src="../../tourist.js"></script>
    <script type="text/javascript src=script.js"></script>
    <link rel="icon" href="../../img/zaplanuj.jpg" type="image/x-icon"> <!-- miniaturka na pasku-->
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <link rel="stylesheet" type="text/css" href="../style_profile.css">
    <link rel="stylesheet" type="text/css" href="../../login/style_login.css">
</head>
<body>
    <?php
        if(isset($_SESSION['login'])) $sesLog = $_SESSION['login'];
        else $sesLog = "";
        echo showHeader($sesLog, '../../index.php', '../../profile/index.php', '../../login/logout.php', '../../login/register.php', '../../login/login.php', '../../img/avatars/'.$img.'.png');
    ?>
    <br><br><br>
    <?php
    if (isset($_REQUEST['password'])){
        $name = stripslashes($_REQUEST['name']);
        $name = mysqli_real_escape_string($connection,$name);
        $name = ucfirst($name);

        $surname = stripslashes($_REQUEST['surname']);
        $surname = mysqli_real_escape_string($connection,$surname);
        $surname = ucfirst($surname);

        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($connection,$email);

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($connection,$password);

        $query = "update users set name='$name', surname='$surname', email='$email', password='".md5($password)."' where login = '$log'";
        $result = mysqli_query($connection,$query);
        if($result){
            echo "<div class='login-container'>
           <div class='login-title' style='font-size:18px'>Dane zostały zmienione!</div>
            <a href='../../index.php'><div class='submit'>Wróć na stronę główną</div></a></div>";
        }
    }else{
        ?>
        <div class="login-container">
            <div class="login-title">Zmiana danych</div>
            <form name="register" action="" method="post">
                <div class="login-row">
                    <div class="login-info-text">Imię: </div>
                    <div class="login-info-input"><input type="text" name="name" placeholder="Podaj imię" value=<?php echo $name1;?> required </input></div>
                    <div class="login-info-text">Nazwisko: </div>
                    <div class="login-info-input"><input type="text" name="surname" placeholder="Podaj nazwisko"  value="<?php echo $surname1;?>" required </input></div>
                    <div class="login-info-text">Login: </div>
                    <div class="login-info-input"><input type="text" name="login" placeholder="Podaj login" value="<?php echo $login1;?>" disabled required </input></div>
                    <div class="login-info-text">Email: </div>
                    <div class="login-info-input"><input type="email" name="email" placeholder="Podaj adres e-mail" value="<?php echo $email1;?>" required </input></div>
                    <div class="login-info-text">Nowe hasło: </div>
                    <div  class="login-info-input"><input oninput="comparePassword('pwd', 'pwd2')" id="pwd" type="password" name="password" placeholder="Podaj hasło"  required </input></div>
                    <div class="login-info-text">Powtórz hasło: </div>
                    <div  id="submit" class="login-info-input"><input oninput="comparePassword('pwd', 'pwd2')" id="pwd2" type="password" name="password2" placeholder="Powtórz hasło"  required </input></div>
                </div>
                <div id="pwd-info"></div>
                <input class="submit" type="submit" name="submit" value="Zmień dane" />
            </form>
        </div>
    <?php } ?>
<br><br><br>
    <script>
        function comparePassword(pass1, pass2) {
            let pwd = document.getElementById(pass1);
            let pwd2 = document.getElementById(pass2);

            pwd2.oninput = function () {
                if (pwd.value !== pwd2.value) {
                    document.getElementById("pwd-info").innerHTML = "Podane hasła są różne!";
                } else {
                    document.getElementById("pwd-info").innerHTML = "";
                }
            };

            pwd.oninput = function () {
                if (pwd.value !== pwd2.value) {
                    document.getElementById("pwd-info").innerHTML = "Podane hasła są różne!";

                } else {
                    document.getElementById("pwd-info").innerHTML = "";
                }
            };
        }

    </script>
<?php echo $footer;?>
</body>
</html>
