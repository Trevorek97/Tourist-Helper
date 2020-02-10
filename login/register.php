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
        <button id="logButton" onclick="document.location='login.php'">Zaloguj</button>
    </div>
</header>
<br><br><br>

<?php
// If form submitted, insert values into the database.
if (isset($_REQUEST['login'])){


    $name = stripslashes($_REQUEST['name']);
    $name = mysqli_real_escape_string($connection,$name);
    $name = ucfirst($name);

    $surname = stripslashes($_REQUEST['surname']);
    $surname = mysqli_real_escape_string($connection,$surname);
    $surname = ucfirst($surname);

    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($connection,$email);

    $login = stripslashes($_REQUEST['login']);     // removes backslashes
    $login = mysqli_real_escape_string($connection,$login);     //escapes special characters in a string

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($connection,$password);

    $registerDate = date("Y-m-d H:i:s");

    $sqlcheck = "select id from users where login='$login' or email = '$email'";
    $resultcheck = $connection->query($sqlcheck);
    if($resultcheck->num_rows >0) {
        echo "<div style='text-align:center; font-size:20px; font-weight:600; color:red'>Login lub email zajęte!</div>";
        echo "<div class='submit' onclick='window.location=\"register.php\"'>Powrót</div>";
    }
    else {
        $query = "INSERT into users (name, surname, login, password, email, registerdate)
VALUES ('$name' ,'$surname', '$login', '" . md5($password) . "', '$email', '$registerDate')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "<div class='login-container'>
           <div class='login-title' style='font-size:18px'>Gratulacje $name, od teraz jesteś zarejestrowany!</div>
            <a href='login.php'><div class='submit'>Zaloguj się!</div></a></div>";
        }
    }
}else{
    ?>
    <div class="login-container">
        <div class="login-title">Rejestracja nowego użytkownika</div>
        <form name="register" action="" method="post">
            <div class="login-row">
                <div class="login-info-text">Imię: </div>
                <div class="login-info-input"><input type="text" name="name" placeholder="Podaj imię" required </input></div>
                <div class="login-info-text">Nazwisko: </div>
                <div class="login-info-input"><input type="text" name="surname" placeholder="Podaj nazwisko" required </input></div>
                <div class="login-info-text">Login: </div>
                <div class="login-info-input"><input type="text" name="login" placeholder="Podaj login" required </input></div>
                <div class="login-info-text">Email: </div>
                <div class="login-info-input"><input type="email" name="email" placeholder="Podaj adres e-mail" required </input></div>
                <div class="login-info-text">Hasło: </div>
                <div  class="login-info-input"><input oninput="comparePassword('pwd', 'pwd2')" id="pwd" type="password" name="password" placeholder="Podaj hasło" required </input></div>
                <div class="login-info-text">Powtórz hasło: </div>
                <div  id="submit" class="login-info-input"><input oninput="comparePassword('pwd', 'pwd2')" id="pwd2"type="password" name="password2" placeholder="Powtórz hasło" required </input></div>
            </div>
            <div id="pwd-info"></div>
            <input class="submit" type="submit" name="submit" value="Zarejestruj!" />
        </form>
    </div>
<?php } ?>

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
