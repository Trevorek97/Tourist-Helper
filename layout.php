<?php
    include_once('database/database.php');
    $footer = "<br><br><br>
               <footer>
               &copy; 2020 by <a id=\"github\" target=\"_blank\" href=\"http://github.com/Trevorek97\">Damian Kita</a>
               <br> Engineering Thesis, Cracow University of Technology
               </footer>";

    $headInfo = "<meta charset=\"UTF-8\">
               <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, minimum-scale=1.0\" />
               <meta name=\"description\" content=\"Tourist helper - aplikacja ułatwiająca podróżowanie\">
               <link href=\"https://fonts.googleapis.com/css?family=Permanent+Marker&display=swap\" rel=\"stylesheet\">
               <link href=\"https://fonts.googleapis.com/css?family=Pacifico&display=swap\" rel=\"stylesheet\">";

    function showHeader($session, $main, $profile, $logout, $register, $login, $image) {
        echo "<header>
            <div id=\"title\"><a style=\"text-decoration:none\" href=". $main .">Tourist Helper</a></div><div id=\"topMenu\">";
            if($session!='') {
                echo " <a href='". $profile ."'><img class='avatar' src='" . $image . "' alt=''></a>";
                echo "<span class='username'> " . $session . "</span>";
                echo "<button id='logButton' onclick=\"document . location = '" . $logout ."'\">Wyloguj</button>";
            } else {
                echo "<button id='logButton' style='right:160px' onclick=\"document . location = '". $register ."'\">Zarejestruj</button>";
                echo "<button id='logButton' onclick=\"document . location = '". $login ."'\">Zaloguj</button>";
            }
            echo "</div> </header>";
    }


    function title($id=24, $var="")
    {
        $pageTitle[0] =  " | Tourist Helper";
        $pageTitle[1] =  "Strona główna";
        $pageTitle[2] =  "Panel administracyjny";
        $pageTitle[3] =  "Dodaj artykuł - Panel administracyjny";
        $pageTitle[4] =  "Usuń artykuł - Panel administracyjny";
        $pageTitle[5] =  "Dodaj lokację - Panel administracyjny";
        $pageTitle[6] =  "Usuń lokację - Panel administracyjny";
        $pageTitle[7] =  "Pytania od użytkowników - Panel administracyjny";
        $pageTitle[8] =  "Zablokuj użytkownika - Panel administracyjny";
        $pageTitle[9] =  "Aktualności";
        $pageTitle[10] = "$var - Aktualności";   //Artykuły danej kategorii
        $pageTitle[11] = "Autor $var - Aktualności"; //Artykuły danego autora
        $pageTitle[12] = "$var - Aktualności"; //Artykuł
        $pageTitle[13] = "Szukaj lokacji - Przewodnik";
        $pageTitle[14] = "Wyniki wyszukiwania - Przewodnik";
        $pageTitle[15] = "$var - Przewodnik"; //Informacje o lokacji
        $pageTitle[16] = "O nas";
        $pageTitle[17] = "Kontakt";
        $pageTitle[19] = "FAQ";
        $pageTitle[20] = "Dodano nowy artykuł - Panel administracyjny";
        $pageTitle[21] = "Usunięto artykuł - Panel administracyjny";
        $pageTitle[22] = "Dodano nową lokację - Panel administracyjny";
        $pageTitle[23] = "Usunięto lokację - Panel administracyjny";
        $pageTitle[24] = "Tourist Helper - Pomocnik Turysty";
        $pageTitle[25] = "Wysłanie wiadomości - Kontakt";
        $pageTitle[26] = "Mapa";
        $pageTitle[27] = "Zarejestruj się";
        $pageTitle[28] = "Użytkownicy - Panel administracyjny";
        $pageTitle[29] = "Potwierdź wykonanie zmiany - Panel administracyjny";
        $pageTitle[30] = "Użytkownik $var usunięty! - Panel administracyjny";
        $pageTitle[31] = "Nowy administrator $var! - Panel administracyjny";
        $pageTitle[32] = "Usunięty administrator $var! - Panel administracyjny";
        $pageTitle[33] = "Pytania użytkowników - Panel administracyjny";
        return "<title>" . $pageTitle[$id] . $pageTitle[0] . "</title>";
    }


    $tooltip = "Możesz użyć tagów HTML do edycji treści artykułu, np: <br>
    * &lt;br&gt; przeniesie tekst do nowej linii <br>
    * &lt;i&gt; &lt;/i&gt; pochyli tekst <br>
    * &lt;strong&gt; &lt;/strong&gt; pogrubi tekst <br>
    * &lt;u&gt; &lt;/u&gt; podkreśli tekst";


    ?>