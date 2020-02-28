<?php
    include_once ('../database/database.php');

    function readPositions($pos) {

        $pos = str_replace("[","",$pos);
        $pos = str_replace("]","",$pos);
        $pos = str_replace("\"","",$pos);

        $position = explode(",", $pos );

        $position[1] = $position[1]/60;
        $position[2] = $position[2]/3600;

        $position[4] = $position[4]/60;
        $position[5] = $position[5]/3600;

        $lat = $position[0]+$position[1]+$position[2];
        $lon = $position[3]+$position[4]+$position[5];

        $position_tab = [$lat, $lon];

        return $position_tab;
    }
?>

