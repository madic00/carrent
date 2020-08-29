<?php 

    require "../../config/connection.php";
    require "../functions.php";
    require "functionsCar.php";

    header("Content-Type: application/json");

    if(isset($_POST['btnUpdateCar'])) {
        extract($_POST);

        require "dataForm.php";

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

        $folderCar = USER_SLIKE ;

        if(!file_exists($folderCar)) {
            mkdir($folderCar, 0777, true);    
        }

        if(isset($_FILES['coverPhoto'])) {
            $coverSlika = $_FILES['coverPhoto'];

            $mainImg = $folderCar . "/" . $coverSlika['name'];

            $putanjaZaBazu ="/" . $coverSlika['name'];

            $rezSlike = move_uploaded_file($coverSlika['tmp_name'], $mainImg);

            oobradiVelicinuSlike($_FILES['coverPhoto'], $mainImg);
        }

        if(isset($_FILES['otherPhoto'])) {
            $sekSlika1 = $_FILES['otherPhoto'];

            $sekImg = $folderCar . "/" . $sekSlika1['name'];

            $putanjaZaBazu1 ="/" . $sekSlika1['name'];

            $rezSekSlike = move_uploaded_file($sekSlika1['tmp_name'], $sekImg);

            obradiVelicinuSlike($_FILES['otherPhoto'], $sekImg);
        }

        if(isset($_FILES['otherPhoto2'])) {
            $sekSlika2 = $_FILES['otherPhoto2'];

            $sekImg2 = $folderCar . strtolower($sekSlika2['name']);

            $putanjaZaBazu2 = "/" . strtolower($carName) . "/" . $sekSlika2['name'];

            $rezSekSlike2 = move_uploaded_file($sekSlika2['tmp_name'], $sekImg2);

            obradiVelicinuSlike($_FILES['otherPhoto2'], $sekImg2);
        }

        if(count($greske) == 0) {
            $upit = "UPDATE vehicles SET name = :carName, brandId = :brandId, categoryId = :categoryId, description = :desc,";

            if(isset($coverSlika)) {
                $upit .= " mainImg = $putanjaZaBazu,";
            }

            $upit .= " modelYear = :modelYear, mileage = :mileage, transmissionId = :transmissionId, seats = :seats, doors = :doors, luggage = :luggage, fuelId = :fuelId WHERE vehicleId = :carId";

            $dataZaUpdate = [
                "carName" => $carName,
                "brandId" => $brandName,
                "categoryId" => $categoryName,
                "desc" => $desc,
                "modelYear" => $modelYear,
                "mileage" => $mileage,
                "transmissionId" => $transmissiontype,
                "seats" => $seats,
                "doors" => $doors,
                "luggage" => $luggage,
                "fuelId" => $fuelType,
                "carId" => $carId
            ];

            $stmt = $db->prepare($upit);

            try {
                $stmt->execute($dataZaUpdate);

                // $odg = "promenjeno";

            } catch(PDOException $ex) {
                handleGresku($ex->getMessage());
                $odg = "You must select valid vehicle id";
            }

            $featureId = 7;

            foreach($opremaVrednosti as $key => $ovrednost) {
                $upitOprema = "UPDATE vehiclesfeatures SET featureValue = :val WHERE featureId = :featureId AND vehicleId = :carId";

                $featuresData = [$featureId, $carId, $ovrednost];

                // $rez = izvrsiInsert($upit, $featuresData);

                $stmtOprema = $db->prepare($upitOprema);

                try {
                    $stmtOprema->execute(["val" => $ovrednost, "featureId" => $featureId, "carId" => $carId]);

                    // echo "uspesno insert u vehiclefeatures";

                } catch (PDOException $ex) {
                    echo $ex->getMessage();
                }

                $featureId++;
             
            }

            $upitCena = "INSERT INTO prices VALUES (NULL, :vehicleId, :price, :datum)";

            $stmtCena = $db->prepare($upitCena);

            $datum = date("Y-m-d H:i:s");

            try {
                $stmtCena->execute(["vehicleId" => $carId, "price" => $price, "datum" => $datum]);
            } catch(PDOException $ex) {
                // $odg = ""

                echo $ex->getMessage();
            }

            http_response_code(200);

            $odg = true;

        } else {
            $odg = $greske;
        }


    } else {
        $odg = "Nije kliknuto na submit";
    }

    echo json_encode(["odg" => $odg]);

?>