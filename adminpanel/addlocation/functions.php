<?php
    include_once("database.php");
    $connection = connectDB();

    function checkString($str, $tab){
        for ($i = 0; $i < count($tab); $i++) {
            if (strpos($str, $tab[$i]) !== false) return 0;
            else continue;
        }
        return 1;
    }

    function checkAndAdd($link, $place, $placetype, $voivodeship, $name, $connection){
        if(empty($link) || empty($place) || empty($placetype) 
           || empty($voivodeship) || empty($name)) {
            $message = "Błąd! Brakuje kluczowych danych!";
            return $message;
        }

        ini_set("allow_url_fopen", true);
        $content = file_get_contents($link);
        preg_match_all('/<img.*src=\"(.*)\".*>/iU', $content, $images);

        $sql = "select keyword from keywords";
        $result = $connection->query($sql);
        $keyword=[];
        $i=0;
        while($row = $result->fetch_assoc()){
            $keyword[$i++] = $row['keyword'];
        }

        $success = true;
        $placetypeInt = checkLocationType($placetype);

        $sql2 = "insert into location(voivodeship, place, name, type) values
            ('$voivodeship', '$place', '$name', '$placetypeInt')";
        if($connection->query($sql2) === TRUE) {}
        else {
            echo "Error: " . $sql2 . "<br>" . $connection->error;
            $success = false;
        }

        $sql = "select id_location from location where name = '$name'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        $id_location = $row['id_location'];

            for ($i = 0; $i < count($images[0]) - 2; $i++) {
                $value = $images[0][$i];
                if (!checkString($value, $keyword)) {
                    continue;
                }

                $sql = "select count(*) as 'x' from photo where photo='$value'";
                $result = $connection->query($sql);
                $row = $result->fetch_assoc();
                if ($row['x'] > 0) {
                } else {
                    $url = readString($value);
                    $sql2 = "insert into photo(photo, location, url) values
                        ('$value', '$id_location', '$url')";
                    if ($connection->query($sql2) === TRUE) {
                    } else {
                        echo "Error: " . $sql2 . "<br>" . $connection->error;
                        $success = false;
                    }
                }
            }

        if($success === false) {
            $message = "Niepowodzenie w dodaniu nowej lokacji!";
        } else {
            $message = "Dodano nową lokację typu " . $placetype . "
                        w miejscowości ". $place . "!";
        }
        $connection->close();
        return $message;
    }


    function readString($toRead){
        $pieces = explode(" ", $toRead);
        $cutStart = substr($pieces[2], 7);
        $url = substr($cutStart, 0,-1);
        return $url;
    }

    function searchResults($type, $voivodeship, $connection){
        $sql = "select location.name as 'name', location.place as 'place' from location, locationType, voivodeship
                where voivodeship.id_voivodeship = location.voivodeship and locationType.id_locationType = location.type 
                and voivodeship.id_voivodeship = '$voivodeship' and locationType.id_locationType = '$type'";
        $result = $connection->query($sql);
       $row = $result->fetch_assoc();
            echo $row["name"] . "<br>" . $row["place"] . "<br>----------------<br>";
    }

    function checkLocationType($placetype){
        if($placetype == 'Zamek/Pałac') return 1;
        else if($placetype == 'Świątynia') return 2;
        else if($placetype == 'Restauracja') return 3;
        else if($placetype == 'Hotel') return 4;
        else if($placetype == 'Inny typ atrakcji') return 5;
    }
?>
