<?php 

    function getSingleBrand($brandId) {
        global $db;

        $upit = "SELECT * FROM brands WHERE brandId = :brandId";

        $stmt = $db->prepare($upit);

        $stmt->bindParam(":brandId", $brandId);

        try {
            $stmt->execute();

            $result = $stmt->fetch();

        } catch(PDOException $ex) {
            $result = "Sorry, we don't have brandy with specified  id";
        }

        return $result;
    }

?>