<?php
    include_once('../../database/database.php');

    function sendMessage($connection, $name, $surname, $mail, $topic, $content)
    {

        $sql = "insert into user_message(topic, name, surname, mail, content) values
        ('$topic', '$name', '$surname', '$mail', '$content')";
        if($connection->query($sql) === TRUE) {

            $sql2 = "select id from user_message where content='$content' and name='$name' and surname='$surname'";
            $result = $connection->query($sql2);
            $messageid = $result->fetch_assoc();

            $message = "Twoja wiadomość o identyfikatorze " . $messageid["id"] . " została poprawnie wysłana i przekazana administracji aplikacji.
            Oczekuj na odpowiedź!";
        }
        else {
            $message = "Niepowodzenie w wysłaniu wiadomości. Spróbuj ponownie później.";
        }


        return $message;
    }

?>