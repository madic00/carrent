<?php 

// define("ABSOLUTE_PATH", $_SERVER['DOCUMENT_ROOT']);
define("ABSOLUTE_PATH", $_SERVER['DOCUMENT_ROOT'] . "/carrent");

// echo ABSOLUTE_PATH;

define("ENV_FAJL", ABSOLUTE_PATH . "/config/.env");
// define("CONNECTION", ABSOLUTE_PATH . "/config/connection.php");
define("USER_SLIKE", ABSOLUTE_PATH . "/assets/img");
define("SLIKE_FOLDER", "assets/img/");
define("LOG_FAJL", ABSOLUTE_PATH . "/data/log.txt");
define("GRESKE", ABSOLUTE_PATH . "/data/errors.txt");
define("ULOGOVANIKOR", ABSOLUTE_PATH . "/data/loggedUsers.txt");
define("SEPARATOR", "\t");

define("SERVER", izvuciIzEnv("SERVER"));
define("DBNAME", izvuciIzEnv("DBNAME"));
define("USERNAME", izvuciIzEnv("USERNAME"));
define("PASSWORD", izvuciIzEnv("PASSWORD"));

function izvuciIzEnv($naziv) {
    $podaci = file(ENV_FAJL);
    $vrednost = "";
    foreach ($podaci as $key => $value) {
        $red = explode("=", $value);
        if($red[0] == $naziv) {
            $vrednost = trim($red[1]);
        }
    }

    return $vrednost;
}