<?php 

    session_start();

    header("Content-Type: application/json");

    require "../../config/connection.php";
    require "../functions.php";

    if(isset($_POST['btnInsert'])) {
        $brandName = $_POST['brandName'];

        $greske = [];
        $greskaBrand = "";

        $polje = [
            "type" => "input",
            "value" => $brandName,
            "regex" => "/^[A-Z][a-z\d\s\.]{3,40}$/",
            "example" => "Mercedes"
        ];

        proveriInput($polje);

        if(count($greske) == 0) {

            $upit = "INSERT INTO brands VALUES(NULL, :brandname)";

            $stmt = $db->prepare($upit);

            $stmt->bindParam(":brandname", $brandName);

            try {
                $rez = $stmt->execute();

                // echo "uneseno \t " . $rez;

                $status = true;
                $text = "Successfully inserted";

                http_response_code(200);
            } catch(PDOException $ex) {
                // u log fajl exception
                handleGresku($ex->getMessage());

                $text = "Brand with this name already exists";
                $status = false;
                
                http_response_code(400);
                // echo $greskaBrand;

                // $_SESSION['greskaBrand'] = $greskaBrand;

                // header("Location: index.php?page=admin&adminPage=brands");
            }

        } else {
            $status = false;
            $text = "Error, example format: " . $polje['example'];

            http_response_code(400);
            
            // header("Location: " . $_SERVER['DOCUMENT_ROOT'] . "/index.php?page=admin&adminPage=brands");
        }

        echo json_encode(["status" => $status, "text" => $text]);
    }

?>