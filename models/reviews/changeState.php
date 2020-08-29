<?php 

    header("Content-Type: application/json");

    require "../../config/connection.php";
    require "../functions.php";

    if(isset($_POST['btnChangeState'])) {
        $reviewId = $_POST['reviewId'];
        $status = $_POST['reviewStatus'];


        $upit = "UPDATE reviews SET reviewStatus = :noviStatus WHERE reviewId = :reviewId";

        $stmt = $db->prepare($upit);

        try {
            $stmt->execute(["noviStatus" => $status, "reviewId" => $reviewId]);

            http_response_code(200);

            $odg = true;
        } catch(PDOException $ex) {
            //zabelezi gresku
            handleGresku($ex->getMessage());

            http_response_code(400);

            $odg = $ex->getMessage();

            $odgTxt = "Select valid review item";
        }

    } else {
        http_response_code(400);

        $odg = false;
        $odgTxt = "SUbmit forme first!";
    }

    echo json_encode(['odg' => $odg]);

?>