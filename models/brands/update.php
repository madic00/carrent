<?php

    header("Content-Type: application/json");

    require "../../config/connection.php";
    require "../functions.php";

    if(isset($_POST['brandId'])) {
        $brandId = $_POST['brandId'];
        $brandName = $_POST['brandName'];

        $upit = "UPDATE brands SET brandName = :brandName WHERE brandId = :brandId";

        $stmt = $db->prepare($upit);

        try {
            $rez = $stmt->execute(["brandId" => $brandId, "brandName" => $brandName]);

            $status = true;
            $text = "Successfully updated";

            http_response_code(200);

        } catch(PDOException $ex) {
            handleGresku($ex->getMessage());

            $status = false;
            $text = "Select valid brand";

            http_response_code(400);

        }

        echo json_encode(["status" => $status, "text" => $text]);
    }

?>