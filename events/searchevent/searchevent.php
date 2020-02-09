<?php


function searchevent($connection, $city, $voivodeship, $locationname) {
    $date = date("Y/m/d");
    if($city == '' and $voivodeship == 0 and $locationname =='') {
        $sql = "select event.id as 'id', event.name as 'name', location.name as 'locationname', event.startdate as 'startdate', event.enddate as 'enddate' from event, location  where event.location = location.id and enddate >= '$date' order by event.id desc";
    }
    else {
        $i = 0;
        $text = [];
        if ($city != '') {
            $text[$i++] = "city.name like '%$city%'";
        }
        if ($voivodeship != 0) {
            $text[$i++] = "city.voivodeship = '$voivodeship'";
        }
        if ($locationname != '') {
            $text[$i++] = "location.name like '%$locationname%'";
        }

        $result = '';
        for ($j = 0; $j < $i; $j++) {
            $result = $result . " " . $text[$j];
            if ($j != $i - 1) {
                $result = $result . " and ";
            }
        }

        $sql = "select event.id as 'id', location.name as 'locationname', event.name as 'name', event.startdate as 'startdate', event.enddate as 'enddate' from event, location, city, voivodeship where " . $result . " and city.id = location.city and voivodeship.id = city.voivodeship and event.location = location.id and enddate >= '$date' order by event.id desc";
    }
    $res = $connection->query($sql) or die ($connection->error);
    return $res;
}




?>