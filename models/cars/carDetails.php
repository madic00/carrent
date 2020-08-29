<?php 

    function ispisiLiOpreme($data) {
        $out = "";

        foreach ($data as $key => $single) {
            $flatKlasa = "";

            if($single['featureValue'] == 1) {
                $flatKlasa = "flaticon-check";
            } else {
                $flatKlasa = "flaticon-cancel";
            }
            
            $out .= "
                <li class='check'>
                    <span class='$flatKlasa'></span>" . $single['featureName']
                . "</li>
            ";
        }

        echo $out;
    }

    if(isset($_GET['carId'])) {
        $carId = $_GET['carId'];

        $upitCar = "SELECT v.*, b.brandName, f.fuelType, p.pricePerDay, t.transmissionType, c.categoryName
        FROM ( SELECT DISTINCT vehicleId, pricePerDay FROM prices  order by date DESC) as p INNER JOIN  vehicles v ON p.vehicleId = v.vehicleId INNER JOIN brands b ON v.brandId = b.brandId INNER JOIN fuels f ON v.fuelId = f.fuelId INNER JOIN categories c ON v.categoryId = c.categoryId INNER JOIN transmissions t ON v.transmissionId = t.transmissionId WHERE v.vehicleId = :carId LIMIT 1";
        $stmt = $db->prepare($upitCar);
        $stmt->bindParam(":carId", $carId);

        $upitOprema = "SELECT vf.*, f.featureName FROM vehiclesfeatures vf INNER JOIN features f ON vf.featureId = f.featureId WHERE vehicleId = :carId";

        $stmtOprema = $db->prepare($upitOprema);
        $stmtOprema->bindParam(":carId", $carId);


        $upitReview = "SELECT r.reviewText, u.firstName, u.lastName FROM reviews r INNER JOIN users u ON r.userId = u.userId WHERE reviewStatus = 1 AND vehicleId = :carId";

        $stmtReview = $db->prepare($upitReview);
        $stmtReview->bindParam(":carId", $carId);

        $upitSlike = "SELECT * FROM images WHERE vehicleId = :carId";

        $stmtSlike = $db->prepare($upitSlike);
        $stmtSlike->bindParam(":carId", $carId);

        try {
            
            $stmt->execute();
            
            $car = $stmt->fetch();

            
            $stmtOprema->execute();

            $oprema = $stmtOprema->fetchAll();

            // var_dump($car);

            $stmtReview->execute();

            $reviews = $stmtReview->fetchAll();

            $stmtSlike->execute();

            $slike = $stmtSlike->fetchAll();

            $relatedCars = handleRelated();

        } catch(PDOException $ex) {
            // nema auto sa tim id-jem
        }
    }

    function handleRelated() {
        global $db;
        global $car;

        // $upitRelated = "SELECT * FROM cardetails WHERE fuelId = :carFuel AND transmissionId = :carTransmission AND vehicleId != :carId LIMIT 3";
        $upitRelated = "SELECT v.*, b.brandName, f.fuelType, p.pricePerDay, t.transmissionType
        FROM ( SELECT DISTINCT vehicleId, pricePerDay FROM prices  order by date DESC) as p INNER JOIN  vehicles v ON p.vehicleId = v.vehicleId INNER JOIN brands b ON v.brandId = b.brandId INNER JOIN fuels f ON v.fuelId = f.fuelId INNER JOIN transmissions t ON v.transmissionId = t.transmissionId WHERE v.fuelId = :carFuel AND v.vehicleId != :carId LIMIT 3";

        $stmtRelated = $db->prepare($upitRelated);

        $stmtRelated->bindParam(":carFuel", $car['fuelId']);
        // $stmtRelated->bindParam(":carTransmission", $car['transmissionId']);
        $stmtRelated->bindParam(":carId", $car['vehicleId']);

        try {
            $stmtRelated->execute();

            $rezRelated = $stmtRelated->fetchAll();
        } catch(PDOException $ex) {

        }

        return $rezRelated;
    }


?>