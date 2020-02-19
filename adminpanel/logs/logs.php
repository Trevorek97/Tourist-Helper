<?php
    function setLogType($type){
        if ($type == 1) $message = "Nowa sesja";
        else if ($type == 2) $message = "Koniec sesji";
        else if ($type == 3) $message = "Dodanie użytkownika";
        else if ($type == 4) $message = "Dodanie lokacji";
        else if ($type == 5) $message = "Nowe wydarzenie";
        else if ($type == 6) $message = "Nowy artykuł";
        else if ($type == 7) $message = "Usunięta lokacja";
        else if ($type == 8) $message = "Usunięty artykuł";
        else if ($type == 9) $message = "Usunięte wydarzenie";
        else $message = "Inny/Nieznany";
        return $message;
    }
?>