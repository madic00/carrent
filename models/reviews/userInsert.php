<?php 

    session_start();

    header("Content-Type: application/json");

    require "../../config/connection.php";
    require "../functions.php";

    if(isset($_POST['btnInsertReview'])) {
        $reviewTxt = $_POST['reviewTxt'];
        $userId = $_SESSION['user']['userId'];
        $vehicleId = $_POST['vehicleName'];

        $upit = "INSERT INTO reviews VALUES (NULL, :userId, :vehicleId, :reviewText, :reviewStatus)";

        $stmt = $db->prepare($upit);

        $reviewStatus = 0;

        try {
            $stmt->execute(['userId' => $userId, "vehicleId" => $vehicleId, "reviewText" => $reviewTxt, "reviewStatus" => $reviewStatus]);

            http_response_code(200);

            $odg = true;
        } catch(PDOException $ex) {
            handleGresku($ex->getMessage());

            http_response_code(400);

            $odg = "You can't add review to this vehicle";
        }

    } else {

        http_response_code(400);
        $odg = "Submit form first";
    }

    echo json_encode(["odg" => $odg]);


?>