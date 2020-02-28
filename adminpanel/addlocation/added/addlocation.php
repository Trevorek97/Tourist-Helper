<?php
    include_once("../../../database/database.php");

    function checkString($str, $tab){
        for ($i = 0; $i < count($tab); $i++) {
            if (strpos($str, $tab[$i]) !== false) return 0;
            else continue;
        }
        return 1;
    }

    function addPhotos($link, $id_location, $connection){
    if(empty($link) || empty($id_location)) {
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
        $sql2 = "insert into photo(photo, location, url) values ('$value', '$id_location', '$url')";
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
        $message = "Dodano nową lokację !";
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
?>



