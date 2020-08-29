<?php 

    header("Content-Type: application/json");

    require "../../config/connection.php";
    require "../functions.php";

    if(isset($_POST['editReviewBtn'])) {
        $reviewId = $_POST['reviewId'];
        $reviewTxt = $_POST['reviewTxt'];

        $upit = "UPDATE reviews SET reviewText = :reviewTxt WHERE reviewId = :reviewId";

        $stmt = $db->prepare($upit);

        try {
            $stmt->execute(["reviewTxt" => $reviewTxt, "reviewId" => $reviewId]);

            http_response_code(200);

            $odg = true;
        } catch(PDOException $ex) {
            handleGresku($ex->getMessage());

            http_response_code(400);

            $odg = "You can't review this car";
        }
    } else {

        http_response_code(400);
        $odg = "Submit form first";
    }

    echo json_encode(["odg" => $odg]);


?>