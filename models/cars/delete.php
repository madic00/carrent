<?php 

    require "../../config/connection.php";
    require "../functions.php";
    require "functionsCar.php";

    header("Content-Type: application/json");

    if(isset($_POST['btnDeleteCar'])) {
        $carId = $_POST['carId'];

        $upitDelete = "DELETE FROM vehicles WHERE vehicleId = :carId";

        $stmt = $db->prepare($upitDelete);

        try {
            $stmt->execute(["carId" => $carId]);

            $odg = true;
        } catch(PDOException $ex) {
            handleGresku($ex->getMessage());

            $odg = "Select valid car to delete";
        }
    } else {
        $odg = "Submit form first!";
    }

    echo json_encode(["odg" => $odg]);


?>