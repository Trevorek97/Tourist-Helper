<?php
    include_once('../../database/database.php');
    function searchGuide($voivodeship, $city, $name, $type, $connection)
    {
        $i=0;
        $tab = [];
        if($name != '') {
            $sql = "select location.id as 'id' from location where name like '%$name%' order by location.id desc";
        }
        else if ($voivodeship == 0 && $type == 0 && $city == '') {
            $sql = "select location.id as 'id' from location order by location.id desc";
        } else {

            if ($voivodeship != 0) {
                $query[$i++] = "city.voivodeship = '$voivodeship'";
            }

            if ($type != 0) {
                $query[$i++] = "location.type = '$type'";
            }

            if ($city != '') {
                $query[$i++] = "city.name like '%$city%'";
            }

            $result = '';
            for ($j = 0; $j < $i; $j++) {
                $result = $result . " " . $query[$j];
                if ($j != $i - 1) {
                    $result = $result . " and ";
                }
            }
            $sql = "select location.id as 'id' from location, city, voivodeship, type where " . $result . " and city.id = location.city and voivodeship.id = city.voivodeship and type.id = location.type order by location.id desc";
        }
            $list = $connection->query($sql);
            $i=0;
            while($row = $list->fetch_assoc()) {
                $tab[$i] = $row["id"];
                $i++;
            }
            return $tab;
    }

?>