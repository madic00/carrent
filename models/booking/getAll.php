<?php 


    function getAllBooking() {
        // $upit = "SELECT b.*, u.firstName, u.lastName, u.email, u.yearsOfExp, v.name, p.pricePerDay, br.brandName FROM booking b INNER JOIN users u ON b.userId = u.userId INNER JOIN vehicles v ON b.vehicleId = v.vehicleId INNER JOIN brands br ON v.brandId = br.brandId";
        
        $upit = "SELECT b.*, v.name, p.pricePerDay, u.firstName, u.lastName, u.email, u.yearsOfExp, br.brandName FROM ( SELECT DISTINCT vehicleId, pricePerDay FROM prices order by date DESC) as p INNER JOIN vehicles v ON p.vehicleId = v.vehicleId INNER JOIN booking b ON v.vehicleId = b.vehicleId INNER JOIN brands br ON v.brandId = br.brandId INNER JOIN users u ON b.userId = u.userId GROUP BY p.vehicleId, b.status, u.userId ORDER BY u.userId";

        return izvrsiSelect($upit);
    }

    function getAllBookingUser() {
        $userId = $_SESSION['user']['userId'];

        $upit = "SELECT b.*, v.name, p.pricePerDay, u.firstName, u.lastName, u.email, u.yearsOfExp, br.brandName FROM ( SELECT DISTINCT vehicleId, pricePerDay FROM prices order by date DESC) as p INNER JOIN vehicles v ON p.vehicleId = v.vehicleId INNER JOIN booking b ON v.vehicleId = b.vehicleId INNER JOIN brands br ON v.brandId = br.brandId INNER JOIN users u ON b.userId = u.userId WHERE u.userId = $userId GROUP BY p.vehicleId";

        return izvrsiSelect($upit);
    }

?>