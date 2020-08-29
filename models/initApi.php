<?php

    header("Content-Type: application/json;");

    require "../config/connection.php";
    require "functions.php";

    $upitCars = "SELECT * FROM vehicles";
    $cars = izvrsiSelect($upitCars);

    // var_dump($cars);

    $upitBrands = "SELECT * FROM brands";
    $brands = izvrsiSelect($upitBrands);

    $upitCats = "SELECT * FROM categories";
    $cats = izvrsiSelect($upitCats);

    $upitFuels = "SELECT * FROM fuels";
    $fuels = izvrsiSelect($upitFuels);

    $upitTransmision = "SELECT * FROM transmissions";
    $transmission = izvrsiSelect($upitTransmision);

    $upitGlavniMeni = "SELECT * from menu WHERE priority = 1";
    $glavniMeni = izvrsiSelect($upitGlavniMeni);

    $upitMeniKor = "SELECT * FROM menu WHERE priority = 2";
    $korMeni = izvrsiSelect($upitMeniKor);

    $rez = [
        "cars" => $cars,
        "brands" => $brands,
        "cats" => $cats,
        "fuels" => $fuels,
        "transmission" => $transmission,
        "glavniMeni" => $glavniMeni,
        "korMeni" => $korMeni
    ];

    http_response_code(200);

    // var_dump($rez);
    echo json_encode($rez);


?>