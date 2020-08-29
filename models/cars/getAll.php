<?php 

    // require "../functions.php";

    function getAllCars() {
        $upit = "SELECT v.*, b.brandName, f.fuelType, p.pricePerDay, t.transmissionType
        FROM ( SELECT DISTINCT vehicleId, pricePerDay FROM prices  order by date DESC) as p INNER JOIN  vehicles v ON p.vehicleId = v.vehicleId INNER JOIN brands b ON v.brandId = b.brandId INNER JOIN fuels f ON v.fuelId = f.fuelId INNER JOIN transmissions t ON v.transmissionId = t.transmissionId GROUP BY v.vehicleId";

        return izvrsiSelect($upit);
    }


?>