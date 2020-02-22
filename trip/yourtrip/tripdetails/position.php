<?php


function propositions($connection, $pos, $tabid, $distance=0.269792247)
{
    $len = sizeof($pos);

    //Read position of trip locations
    for ($i = 0; $i < $len; $i++) {
        $pos[$i] = str_replace("[", "", $pos[$i]);
        $pos[$i] = str_replace("]", "", $pos[$i]);
        $pos[$i] = str_replace("\"", "", $pos[$i]);

        $position[$i] = explode(",", $pos[$i]);

        $position[$i][1] = $position[$i][1] / 60;
        $position[$i][2] = $position[$i][2] / 3600;

        $position[$i][4] = $position[$i][4] / 60;
        $position[$i][5] = $position[$i][5] / 3600;

        $lat[$i] = $position[$i][0] + $position[$i][1] + $position[$i][2];
        $lon[$i] = $position[$i][3] + $position[$i][4] + $position[$i][5];

    }

    //Read positions of all locations
    $sql = "select id, position from location";
    $result = $connection->query($sql);
    $a = 0;
    while ($row = $result->fetch_assoc()) {
        $locpos = $row["position"];
        $locpos = str_replace("[", "", $locpos);
        $locpos = str_replace("]", "", $locpos);
        $locpos = str_replace("\"", "", $locpos);

        $locposition = explode(",", $locpos);

        $locposition[1] = $locposition[1] / 60;
        $locposition[2] = $locposition[2] / 3600;

        $locposition[4] = $locposition[4] / 60;
        $locposition[5] = $locposition[5] / 3600;

        $loclat[$a] = $locposition[0] + $locposition[1] + $locposition[2];
        $loclon[$a] = $locposition[3] + $locposition[4] + $locposition[5];
        $idloc[$a] = $row["id"];
        $a++;

    }
    $b = 0;
    $index = [];
    $a = 0;
    for ($i = 0; $i < sizeof($idloc); $i++) { //wszystkie lokacje
        $repeat[$i]=false;
        for ($j = 0; $j < sizeof($tabid); $j++) { //lokacje w tripie
            if ($idloc[$i] == $tabid[$j]) { //jesli lokacja w tripie juz jest
                $repeat[$i] = true;
            }
        }
    }

    for ($i = 0; $i < sizeof($idloc); $i++) { //zrob tabele z indeksami ktore nie wystepuja w tripie
        if ($repeat[$i] == false) {
            $tocheckindex[$a] = $idloc[$i];
            $tochecklat[$a] = $loclat[$i];
            $tochecklon[$a] = $loclon[$i];
            $a++;
        }
    }

if($a != 0 ) {
    $x = 0;
    for ($i = 0; $i < sizeof($tabid); $i++) { //sprawdz odleglosci miedzy lokacjami
        for ($j = 0; $j < sizeof($tocheckindex); $j++) {
            if ((abs($tochecklat[$j] - $lat[$i]) <= $distance) && (abs($tochecklon[$j] - $lon[$i]) <= $distance)) {
                $checkindex = false;
                for ($s = 0; $s < sizeof($index); $s++) {
                    if ($index[$s] == $tocheckindex[$j]) {
                        $checkindex = true;
                    }
                }
                if ($checkindex == false) {
                    $index[$x++] = $tocheckindex[$j];
                }
            }
        }
    }
}
return $index;
}
                   /* for ($k = 0; $k < sizeof($tocheckindex); $k++) {
                        if ((abs($tochecklat[$i] - $lat[$k]) <= 0.269792247) && (abs($loclon[$i] - $lon[$k]) <= 0.269792247) && $repeat[$j] == false) {
                            $idset = false;
                            for($s=0;$s<sizeof($index);$s++){
                                if($index[$s] == $idloc[$i]) {
                                    $idset = true;
                                }
                            }
                            if($idset == false) {
                                $index[$b++] = $idloc[$i];
                            }
                        }
                    }
                }
            }
        }*/

    /**
     * 1 stopien = 111 196,672 m
     * 1 km = 1000m
     * x km = 111196,672 m
     *
     * 1 stopien = 111,196672 km
     * x stopni = 30 km
     *  0,269792247 stopnia = 30 km
     */
        //porównaj pozycje z obu tabel,
            //propozycje
/**
 * podane km = (distance)x stopni
 * 111,196672 km = 1 stopien
 *
 * distance = podane/111.
 */
?>