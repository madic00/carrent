<?php 

    header("Content-Type: application/json");

    require "../../config/connection.php";
    require "../functions.php";

    if(isset($_POST['deleteReviewBtn'])) {
        $reviewId = $_POST['reviewId'];

        $upit = "DELETE FROM reviews WHERE reviewId = :reviewId";

        $stmt = $db->prepare($upit);

        try {
            $stmt->execute(["reviewId" => $reviewId]);

            http_response_code(200);
            
            $odg = true;
        } catch(PDOException $ex) {
            handleGresku($ex->getMessage());

            http_response_code(400);

            $odg = "No review with specified id";
        }
    } else {

        http_response_code(400);
        $odg = "Submit form first";
    }

    echo json_encode(["odg" => $odg]);


?>