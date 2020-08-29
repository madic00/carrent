<?php 

    // require "../functions.php";

    function getAllBrands() {
        $upit = "SELECT * FROM brands ORDER BY brandId";

        return izvrsiSelect($upit);
    }

?>