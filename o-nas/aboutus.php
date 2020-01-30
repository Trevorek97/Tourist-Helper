<?php

    function aboutUs($connection) {

        $sql = "select content from aboutus";
        $result = $connection->query($sql);
        $i=0;
        $tab=[];
        while($row = $result->fetch_assoc()) {
            $tab[$i++] = $row["content"];
        }
        return $tab;
    }

?>