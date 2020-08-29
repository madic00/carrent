<?php 

    header("Content-Type: application/json");

    require "../config/connection.php";

    if(isset($_POST['btnCheckEmail'])) {
        $email = $_POST['email'];

        $upit = "SELECT * FROM users WHERE email = :email";

        $stmt = $db->prepare($upit);

        $stmt->bindParam(":email", $email);

        try {
            $stmt->execute();

            $rez = $stmt->fetchAll();

            if($stmt->rowCount()) {
                $odg = "Email is already taken";
            } else {
                $odg = true;
            }

            http_response_code(200);

        } catch(PDOException $ex) {
            http_response_code(400);
            $odg = "Enter valid email";
        }

    } else {

        http_response_code(400);
        $odg = "Enter email first!";
    }

    echo json_encode(["odg" => $odg]);


?>