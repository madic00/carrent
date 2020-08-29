<?php 

$vrednosti = [
    [
        "type" => "input",
        "value" => $carName,
        "regex" => "/^[A-z\s\d\.]{2,30}$/",
        "example" => "Sportage"
    ],
    [
        "type" => "ddl",
        "value" => $brandName,
        "error" => "Select brand"
    ],
    [
        "type" => "ddl",
        "value" => $categoryName,
        "error" => "Select category"
    ],
    [
        "type" => "textarea",
        "value" => $desc,
        "error" => "Description must have at least 10 chars"
    ],
    [
        "type" => "text",
        "value" => $modelYear,
        "regex" => "/^(19|20)[0-9]{2}$/",
        "example" => "2000"
    ],
    [
        "type" => "number",
        "value" => $seats,
        "error" => "Enter positive number"
    ],
    [
        "type" => "number",
        "value" => $doors,
        "error" => "Enter positive number"
    ],
    [
        "type" => "ddl",
        "value" => $fuelType,
        "error" => "Select fuel type"
    ],
    [
        "type" => "ddl",
        "value" => $transmissiontype,
        "error" => "Select transmission type"
    ],
    [
        "type" => "number",
        "value" => $mileage,
        "error" => "Enter positive number"
    ],
    [
        "type" => "number",
        "value" => $luggage,
        "error" => "Enter positive number"
    ],
    [
        "type" => "numberPrice",
        "value" => $price,
        "error" => "Enter positive number between 10 and 500"
    ],
];

$oprema = [
    [
        "idProp" => "aircondition",
        "text" => "Airconditions"
    ],
    [
        "idProp" => "breakSystem",
        "text" => "AntiLock Breaking System"
    ],
    [
        "idProp" => "leatherSeats",
        "text" => "Leather Seats"
    ],
    [
        "idProp" => "brakeAssist",
        "text" => "Brake Assist"
    ],
    [
        "idProp" => "crashSenson",
        "text" => "Crash Sensor"
    ],
    [
        "idProp" => "onboardPc",
        "text" => "Onboard computer"
    ],
    [
        "idProp" => "gps",
        "text" => "GPS"
    ],
    [
        "idProp" => "locking",
        "text" => "Central Locking"
    ],
    [
        "idProp" => "abs",
        "text" => "ABS"
    ],
    [
        "idProp" => "bluetooth",
        "text" => "Bluetooth"
    ],
    [
        "idProp" => "childSeat",
        "text" => "Child Seat"
    ],
    [
        "idProp" => "parkingSensor",
        "text" => "Parking Sensors"
    ]
];

?>