<?php 

    header("Content-Type: application/json");

    require "../../config/connection.php";
    require "../functions.php";

    if(isset($_POST['brandId'])) {
        $brandId = $_POST['brandId'];

        $upit = "DELETE FROM brands WHERE brandId = :brandId";

        $stmt = $db->prepare($upit);

        $stmt->bindParam(":brandId", $brandId);

        $status = "";

        try {
            $stmt->execute();

            $status = true;
            $text = "Successfully deleted";

            http_response_code(200);

        } catch(PDOException $ex) {
            handleGresku($ex->getMessage());
            
            $status = false;
            $text = "We don't have brand with specified id";
            http_response_code(400);
        }

        echo json_encode(["status" => $status, "text" => $text]);

    }

?>