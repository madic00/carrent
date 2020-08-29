<?php

    function getSingleCar() {
        global $carId;

        $upit = "SELECT v.*, b.brandName, f.fuelType, p.pricePerDay, t.transmissionType, c.categoryName
        FROM ( SELECT DISTINCT vehicleId, pricePerDay FROM prices  order by date DESC) as p INNER JOIN  vehicles v ON p.vehicleId = v.vehicleId INNER JOIN brands b ON v.brandId = b.brandId INNER JOIN fuels f ON v.fuelId = f.fuelId INNER JOIN categories c ON v.categoryId = c.categoryId INNER JOIN transmissions t ON v.transmissionId = t.transmissionId WHERE v.vehicleId = $carId";

        $upitOprema = "SELECT vf.*, f.featureName FROM vehiclesfeatures vf INNER JOIN features f ON vf.featureId = f.featureId WHERE vehicleId = $carId";

        $upitSlike = "SELECT * FROM images WHERE vehicleId = $carId";

        $basicInfo = izvrsiSelect($upit);

        $oprema = izvrsiSelect($upitOprema);

        $slike = izvrsiSelect($upitSlike);

        $rez = ["basic" => $basicInfo[0], "oprema" => $oprema, "slike" => $slike];

        return $rez;
    }

    function getSingleIndex() {
        global $carId;
        global $db;

        $upit = "SELECT p.pricePerDay, v.*, b.brandName, f.fuelType, p.pricePerDay, t.transmissionType, c.categoryName
        FROM ( SELECT DISTINCT vehicleId, pricePerDay FROM prices  order by date DESC) as p INNER JOIN  vehicles v ON p.vehicleId = v.vehicleId INNER JOIN brands b ON v.brandId = b.brandId INNER JOIN fuels f ON v.fuelId = f.fuelId INNER JOIN categories c ON v.categoryId = c.categoryId INNER JOIN transmissions t ON v.transmissionId = t.transmissionId WHERE v.vehicleId = $carId";

        $stmt = $db->prepare($upit);

        $stmt->execute();

        return $stmt->fetch();
    }

?>