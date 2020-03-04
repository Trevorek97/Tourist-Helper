<?php

function propositions($connection, $pos, $tabid, $distance=0.269792247)
{
    $len = sizeof($pos);
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

    $sql = "select id, position from location";
    $result = $connection->query($sql);
    $a = 0;
    while ($row = $result->fetch_assoc()) {
        $repeat = false;
        for($i=0;$i<$len;$i++) {
            if($tabid[$i] == $row["id"]) {
                $repeat = true;
                break;
            }
        }
        if($repeat == false) {
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
    }
    $index = [];
    $a = 0;

    for ($i = 0; $i < sizeof($idloc); $i++) {
            $tocheckindex[$a] = $idloc[$i];
            $tochecklat[$a] = $loclat[$i];
            $tochecklon[$a] = $loclon[$i];
            $a++;
        }

        if($a != 0 ) {
            $x = 0;
            for ($i = 0; $i < sizeof($tabid); $i++) {
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
?>
