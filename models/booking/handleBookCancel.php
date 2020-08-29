<?php 

    header("Content-Type: application/json");

    require "../../config/connection.php";
    require "../functions.php";

    if(isset($_POST['btnHandleBook'])) {
        $bookId = $_POST['bookId'];

        $upitCancel = "UPDATE booking SET status = 2 WHERE bookId = $bookId";

        $stmtCancel = $db->prepare($upitCancel);

        try {
            $stmtCancel->execute();

            http_response_code(200);

            $odg = true;
            $odgTxt = "Successfully canceled booking";
            
        } catch(PDOException $ex) {
            $odg = false;
            $odgTxt = "Select valid booking item";
        }

    } else {

    }


    echo json_encode(['odgovor' => $odg, 'odgovorTxt' => $odgTxt]);

?>