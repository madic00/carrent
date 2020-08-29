<?php 

    require "config.php";

    pristupStranici();

    try {
        $db = new PDO("mysql:host=" . SERVER . ";dbname=" . DBNAME . ";charset=utf8", USERNAME, PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $ex) {
        // echo $ex->getMessage(); -> u log fajl
        exit("We have issues with database, please try later");
    }

    function pristupStranici() {
        $fajl = fopen(LOG_FAJL, "a");
        if($fajl) {
            $datum = date("d-m-Y H:i:s");
            fwrite($fajl, $_SERVER['PHP_SELF'] . "\t" .  $datum . "\t" . $_SERVER['REMOTE_ADDR'] ."\t\n");
            fclose($fajl);
        }        
    }

    function handleGresku($err) {
        $fajl = fopen(GRESKE, "a");
        if($fajl) {
            $datum = date("d-m-Y H:i:s");

            fwrite($fajl, $_SERVER['PHP_SELF'] . "\t" . $_SERVER['REQUEST_URI'] . "\t" .  $datum . "\t" . $err . "\t\n");
            fclose($fajl);
        }
    }

    function upisiKorisnikaUFajl($userId) {
        $fajl = fopen(ULOGOVANIKOR, "a");
        if($fajl) {
            // $datum = date("d-m-Y H:i:s");

            $str = "$userId\n";

            fwrite($fajl, $str);
            fclose($fajl);
        }
    }

    function izbrisiKorisnaIzFajla($userId) {
        $niz = file(ULOGOVANIKOR);

        $noviStr = "";

        foreach($niz as $korId) {
            $korId = trim($korId);

            if($korId != $userId) {
                $noviStr .= $korId . "\n";
            }
        }

        // file_put_contents(ULOGOVANIKOR, "");

        $fajl = fopen(ULOGOVANIKOR, "w");

        fwrite($fajl, $noviStr);
        fclose($fajl);
    }

    function handleMetaData($page) {
        $meta = [
            "index" => [
                "title" => "Car Rent | Home",
                "titleForTag" => "",
                "desc" => "We are agency for rent a car. Here you can find best deals",
                "keys" => "carrent, rent a car, best car to rent"
            ],
            "cars" => [
                "title" => "Car Rent | Cars",
                "titleForTag" => "Our For Rent Cars ",
                "desc" => "Here you can see our rich offer of luxury and afordable cars (based on your budget)",
                "keys" => "cars for rent, luxury car, best deal for car rent"
            ],
            "carDetails" => [
                "title" => "Car Rent | Car details",
                "titleForTag" => "Car details",
                "desc" => "Find more information about single car",
                "keys" => "best car for rent, info about car"
            ],
            "about" => [
                "title" => "Car Rent | About",
                "titleForTag" => "About us",
                "desc" => "Find more information about CarRent",
                "keys" => "bio carrent, about, about carrent"
            ],
            "contact" => [
                "title" => "Car Rent | Contact",
                "titleForTag" => "Contact us",
                "desc" => "Contact us for any question you have and maybe negotiate about price",
                "keys" => "contact us, contanct carrent, contanct rent a car"
            ],
            "login" => [
                "title" => "Car Rent | Login",
                "titleForTag" => "Log in",
                "desc" => "Log in to submit request to rent a car",
                "keys" => "log in carrent"
            ],
            "logout" => [
                "title" => "Car Rent | Logout ",
                "titleForTag" => "Log out",
                "desc" => "Logout page of carrent",
                "keys" => "logout carrent, log out from car rent"
            ],
            "register" => [
                "title" => "Car Rent | register",
                "titleForTag" => "Register",
                "desc" => "Register here, to get a chance to rent a car",
                "keys" => "register carrent, register page of rent a car"
            ],
            "adminPanel" => [
                "title" => "Car Rent | Admin",
                "titleForTag" => "Hello admin",
                "desc" => "Admin panel of carrent website",
                "keys" => "adminpanel carrent, admin panel carrent"
            ],
            "profile" => [
                "title" => "Car Rent | User profie",
                "titleForTag" => "Hello user",
                "desc" => "User profie",
                "keys" => "profile at carrent, user at carrent"
            ],
            "author" => [
                "title" => "Car Rent | Author",
                "titleForTag" => "Author",
                "desc" => "Page about author of carrent website",
                "keys" => "about author of carrent, author carrent"
            ]
        ];

        return $meta[$page];

    }

?>