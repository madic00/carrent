<?php 

    function getCarsByUser() {
        $userId = $_SESSION['user']['userId'];

        $upit = "SELECT r.*, v.name, b.brandName FROM reviews r INNER JOIN vehicles v ON r.vehicleId = v.vehicleId INNER JOIN brands b ON v.brandId = b.brandId WHERE userId = $userId";

        return izvrsiSelect($upit);
    }

    function getCarsForInsertReview() {
        $userId = $_SESSION['user']['userId'];

        $upit = "SELECT b.vehicleId, v.name, br.brandName 
        FROM booking b 
            INNER JOIN vehicles v ON b.vehicleId = v.vehicleId INNER JOIN brands br ON v.brandId = br.brandId
        WHERE userId = $userId AND status = 1 AND b.vehicleId NOT IN ( SELECT vehicleId FROM reviews WHERE userId = $userId)";

        return izvrsiSelect($upit);
    }

    function getReviewsAdmin() {
        $upit = "SELECT r.*, u.firstName, u.lastName, v.name, br.brandName 
        FROM reviews r INNER JOIN users u ON r.userId = u.userId INNER JOIN vehicles v ON r.vehicleId = v.vehicleId INNER JOIN brands br ON v.brandId = br.brandId";

        return izvrsiSelect($upit);
    }

    // upit za ddl sa cars
    // $upit = "SELECT v.vehicleId, v.name, br.brandName FROM booking b INNER JOIN vehicles v ON b.vehicleId = v.vehicleId INNER JOIN brands br ON v.brandId = br.brandId WHERE b.userId = $userId";

?>