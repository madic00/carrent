<?php 

    header("Content-Type: application/json");

    require "../../config/connection.php";

    if(isset($_POST['btnUserCancel'])) {
        $bookId = $_POST['bookId'];

        $upitCancel = "UPDATE booking SET status = 2 WHERE bookId = :bookId";

        $stmt = $db->prepare($upitCancel);

        try {
            $stmt->execute(['bookId' => $bookId]);

            $odg = true;
        } catch(PDOException $ex) {
            handleGresku($ex->getMessage());

            $odg = "You can't cancel";
        }

        http_response_code(200);

    } else {
        http_response_code(400);

        $odg = "submit form first";
    }

    echo json_encode(['odg' => $odg]);

?>