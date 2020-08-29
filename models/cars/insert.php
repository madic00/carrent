<?php 

    require "../../config/connection.php";
    require "../functions.php";
    require "functionsCar.php";

    header("Content-Type: application/json");
    
    if(isset($_POST['btnInsertCar'])) {        
        extract($_POST);
        // var_dump($_POST, $_FILES);

        // echo "<hr />";

        $coverSlika = $_FILES['coverPhoto'];
        $sekSlika1 = $_FILES['otherPhoto'];
        $sekSlika2 = $_FILES['otherPhoto2']; 

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

        $greske = [];

        foreach ($vrednosti as $el) {
            if($el["type"] == "number" || $el['type'] == "ddl" || $el['type'] == "numberPrice") {
                proveriNumber($el);
            } else if($el['type'] == "input") {
                proveriInput($el);
            } else if($el['type'] == "textarea") {
                proveriTextarea($el);
            }
        }

        $opremaVrednosti = [];

        foreach($oprema as $single) {
            if(isset($_POST[$single['idProp']])) {
                $opremaVrednosti[] = 1;
            } else {
                $opremaVrednosti[] = 0;
            }
        }

        // var_dump($opremaVrednosti);

        // $folderCar = USER_SLIKE . "/$carName/";

        // if(!file_exists($folderCar)) {
        //     mkdir($folderCar, 0777, true);    
        // } else {
        //     // echo "Folder already exists <br />";
        // }

        $folderCar = USER_SLIKE;


        $mainImg = $folderCar . "/" . $coverSlika['name'];

        $sekImg = $folderCar . "/" . $sekSlika1['name'];

        $sekImg2 = $folderCar . "/" . $sekSlika2['name'];

        $putanjaZaBazu ="/" . $coverSlika['name'];

        $putanjaZaBazu1 ="/" . $sekSlika1['name'];
        $putanjaZaBazu2 ="/" . $sekSlika2['name'];

        $rezSlike = move_uploaded_file($coverSlika['tmp_name'], $mainImg);

        $rezSekSlike = move_uploaded_file($sekSlika1['tmp_name'], $sekImg);
        $rezSekSlike2 = move_uploaded_file($sekSlika2['tmp_name'], $sekImg2);

        if(count($greske) == 0 || $rezSlike == 1) {
            
            obradiVelicinuSlike($_FILES['coverPhoto'], $mainImg);

            obradiVelicinuSlike($_FILES['otherPhoto'], $sekImg);

            obradiVelicinuSlike($_FILES['otherPhoto2'], $sekImg2);


            // echo "Uneli ste sve bez greske";

            $upit = "INSERT INTO vehicles VALUES(NULL, :carName, :brandId, :categoryId, :desc, :mainImg, :modelYear, :mileage, :transmissionId, :seats, :doors, :luggage, :fuelId, :insertedat)";

            $insertedat = date("Y-m-d H:i:s");

            $dataZaInsert = [
                "carName" => $carName,
                "brandId" => $brandName,
                "categoryId" => $categoryName,
                "desc" => $desc,
                "mainImg" => $putanjaZaBazu,
                "modelYear" => $modelYear,
                "mileage" => $mileage,
                "transmissionId" => $transmissiontype,
                "seats" => $seats,
                "doors" => $doors,
                "luggage" => $luggage,
                "fuelId" => $fuelType,
                "insertedat" => $insertedat
            ];
            // echo $rezSlike . " slika je premestena <br />";

            // $rezInsert = izvrsiInsert($upit, $dataZaInsert);

            $stmt = $db->prepare($upit);

            try {
                $stmt->execute($dataZaInsert);
                
            } catch(PDOException $ex) {
                handleGresku($ex->getMessage());
                
            }

            $vehicleId = $db->lastInsertId();

            // echo $rezInsert  . "<br />";

            // echo "Poslednji indeks je $vehicleId";

            $featureId = 7;

            foreach($opremaVrednosti as $key => $ovrednost) {
                $upitOprema = "INSERT INTO vehiclesfeatures VALUES (NULL, :featureId, :carId, :val)";

                $featuresData = [$featureId, $vehicleId, $ovrednost];

                // $rez = izvrsiInsert($upit, $featuresData);

                $stmtOprema = $db->prepare($upitOprema);

                try {
                    $stmtOprema->execute(["featureId" => $featureId, "carId" => $vehicleId, "val" => $ovrednost]);

                    // echo "uspesno insert u vehiclefeatures";

                } catch (PDOException $ex) {
                    echo $ex->getMessage();
                }

                $featureId++;
                
                // echo "$rez <br /> ";

                // echo $upit . "<<br />" . $featureId;
            }

            $upitCena = "INSERT INTO prices VALUES (NULL, :vehicleId, :price, :datum)";

            $stmtCena = $db->prepare($upitCena);

            $datum = date("Y-m-d H:i:s");

            try {
                $stmtCena->execute(["vehicleId" => $vehicleId, "price" => $price, "datum" => $datum]);
            } catch(PDOException $ex) {
                // $odg = ""

                echo $ex->getMessage();
            }

            $slikeZaBazu = [$putanjaZaBazu1, $putanjaZaBazu2];

            foreach ($slikeZaBazu as $key => $slika) {
                $upitSlike = "INSERT INTO images VALUES (NULL, ?, ?)";

                $stmtSlike = $db->prepare($upitSlike);

                $stmtSlike->execute([$slika, $vehicleId]);
            }

            http_response_code(200);

            $odg = true;

        } else {
            // echo "Ima gresaka";

            http_response_code(400);
            $odg = $greske;
        }

    } else {
        http_response_code(400);
        $odg = "Submit form first!";
    }

    echo json_encode(["odg" => $odg]);



?>