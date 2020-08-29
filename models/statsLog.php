<?php

    $open = fopen(LOG_FAJL, "r");
    if($open) {
        $podaci = file(LOG_FAJL);
        fclose($open);
        $n = count($podaci);
        define("DANSEKUNDE", 24 * 60 * 60);
        $logLast24h = [];

        for($i = 0; $i < $n; $i++) {
            $red = explode("\t", $podaci[$i]);
            $t = $red[1];
            $pre24h = time() - DANSEKUNDE;
            $utT = strtotime($t);
            if($utT >= $pre24h) {
                $logLast24h[] = $red[0];
            }
        }

        $n = count($logLast24h);
        $logLast24hDistinct = [];
        for($i = 0; $i < $n; $i++) {
            
            if(!in_array($logLast24h[$i], $logLast24hDistinct )) {
                $logLast24hDistinct[] = $logLast24h[$i];
            }
        }

        $arrFinal = [];
        foreach($logLast24hDistinct as $k => $v) {
            $arrFinal[$v] = 0;
        }

        foreach($arrFinal as $k => $v) {
            foreach($logLast24h as $log) {
                if($k == $log) {
                    $arrFinal[$k] += 1;
                }
            }
        }

        $total = 0;

        foreach($arrFinal as $ar) {
            $total += $ar;
        }


    }

    $brojUlogavnihKor = count(file(ULOGOVANIKOR));

?>
