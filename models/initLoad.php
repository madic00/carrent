<?php

    // require "../config/connection.php";
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

    $rez = [
        "cars" => $cars,
        "brands" => $brands,
        "cats" => $cats,
        "fuels" => $fuels,
        "transmission" => $transmission,
        "glavniMeni" => $glavniMeni
    ];

    // var_dump($rez);


?>